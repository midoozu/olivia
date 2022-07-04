<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\CrmCustomer;
use App\Models\Doctor;
use App\Models\Doctor_Percentage;
use App\Models\DrAppointmentPercent;
use App\Models\Income;
use App\Models\Inventory;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['client', 'doctor', 'services', 'products', 'branch'])->get();

        $crm_customers = CrmCustomer::get();

        $doctors = Doctor::get();

        $services = Service::get();

        $products = Product::get();

        $inventories = Inventory::get();

        return view('admin.appointments.index', compact('appointments', 'crm_customers', 'doctors', 'services', 'products', 'inventories'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Inventory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payType = PaymentType::pluck('payment_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('clients', 'doctors', 'services', 'products', 'branches','payType'));
    }

    public function store(StoreAppointmentRequest $request)
    {

        $appointment = Appointment::create($request->all());
        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));

         Income::firstorCreate([
             'entry_date' => Carbon::now()->toDateString(),
             'amount'=>$request->price,
             'description'=>'Paied by customer',
             'income_category_id'=>1,
             'cs_name_id'=>$request->client_id ,
             'branch_id'=> Auth::user()->branch_id ,

        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Inventory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payType = PaymentType::pluck('payment_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('client', 'doctor', 'services', 'products', 'branch');

        return view('admin.appointments.edit', compact('clients', 'doctors', 'services', 'products', 'branches', 'payType','appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {

        $last = Appointment::where('branch_id',$request->branch_id)->max('pulse');
        $appointment->update(['used_pulse'=> ($request->pulse - $last) ]);
        $appointment->update($request->all());
        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));

        Income::firstorCreate([
            'entry_date' => Carbon::now()->toDateString(),
            'amount'=>$request->price,
            'description'=>'Paied by customer',
            'income_category_id'=>1,
            'cs_name_id'=>$request->client_id ,
            'branch_id'=> Auth::user()->branch_id ,
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('client', 'doctor', 'services', 'products', 'branch');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
