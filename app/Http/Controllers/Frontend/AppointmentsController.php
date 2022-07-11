<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\CrmCustomer;
use App\Models\Doctor;
use App\Models\Income;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AppointmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['client', 'doctor', 'services', 'products', 'branch'])->where('branch_id', Auth::user()->branch_id)->get();

        $crm_customers = CrmCustomer::get();

        $doctors = Doctor::get();

        $services = Service::get();

        $products = Product::get();

        $inventories = Inventory::get();

        return view('frontend.appointments.index', compact('appointments', 'crm_customers', 'doctors', 'services', 'products', 'inventories'));
    }

    public function mainfront(){

        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all();

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Inventory::where('id', Auth::user()->branch_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('frontend.appointments.mainfront', compact('clients', 'doctors', 'services', 'products', 'branches'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Inventory::where('id', Auth::user()->branch_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.appointments.create' , compact('clients', 'doctors', 'services', 'products', 'branches'));

    }


    public function store(StoreAppointmentRequest $request)
    {

        $appointment = Appointment::create($request->all());
        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));

        if ($appointment instanceof Appointment) {
            toastr()->success('Data has been saved successfully!');

        }
else {
    toastr()->error('An error has occurred please try again later.');
}

        return back();


        Income::firstorCreate([
            'entry_date' => Carbon::now()->toDateString(),
            'amount'=>$request->price,
            'description'=>'Paied by customer',
            'income_category_id'=>1,
            'cs_name_id'=>$request->client_id ,
            'branch_id'=> Auth::user()->branch_id ,
        ]);
        return redirect()->back('frontend.appointments.mainfront');
    }
    public function today( )
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['client', 'doctor', 'services', 'products', 'branch'])->where('branch_id', Auth::user()->branch_id)->whereDate('start_time', '=', date('Y-m-d'))->get();
        $test = CrmCustomer::with('clientAppointments.services')->first();

        $services = Service::pluck('name', 'id');
        return view('frontend.appointments.today' ,compact('appointments','services'));
    }

    public function tomorrow( )
    {

        $appointments = Appointment::with(['client', 'doctor', 'services', 'products', 'branch'])->where('branch_id', Auth::user()->branch_id)->whereDate('start_time', '=', Carbon::tomorrow()->toDateString())->get();

        return view('frontend.appointments.tomorrow', compact('appointments'));
    }

    public function entry( Appointment $appointment, Request $request){


        $appointment->update([
            'payment_method'=>$request->payment_method,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'check_in'=>1

        ]);

        if ($appointment->wasChanged) {
            toastr()->success('تم التحديث بنجاح');
        }
        else{
            toastr()->error('لم يتم التحديث');
        }
return redirect()->back();
    }

    public function exit( Appointment $appointment, Request $request){

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $appointment->start_time);
        $daysToAdd = $request->next_session;
        $date = $date->addDays($daysToAdd);

        $next_session = Appointment::create([
            'client_id' =>$appointment->client_id,
            'doctor_id'=>$appointment->doctor_id,
            'start_time'=>$date,
            'branch_id'=>$appointment->branch_id,
        ]);
        $next_session->services()->sync($appointment->services);

        if ($next_session){
            toastr()->success( 'تم حجز الجلسه القادمه يوم '. $next_session->start_time );
        }

        $appointment->update([
            'comment'=>$request->comment,
            'check_out'=>1,
            'power'=> $request->power,
            'pulse'=> $request->pulse,
            'extra_pulse'=>$request->extra_pulse,
            'weight'=>$request->weight,
        ]);
        if ($appointment->wasChanged() ){
            toastr()->success('تم التحديث بنجاح');
        }
        else{
            toastr()->error('لم يتم التحديث');
        }

        return redirect()->back();
    }


public function follow_up(Appointment $appointment){

    $appointment->update([
        'follow_up'=>1
    ]);

        toastr()->success('تمت المتابعه');
        return redirect()->back();
}


public function check(Appointment $appointment){

    $servic = Service::all();
    $test = collect($servic)->map(function ($name , $key)  {
        return (int)$name['name'];
    }) ;
    $intofservice = [];

    foreach ($test as $item){
    if ($item > 0){
        array_push($intofservice,$item );
             }
    }
    $users = Appointment::whereHas('services', function($q) use ($intofservice, $test, $appointment) {
        $q->whereIn('name', $intofservice);
        $q->where('client_id','=',$appointment->client_id);
    })->latest()->first();
    $pulseSum = Appointment::where(function ($q) use ($users, $appointment) {
        $q->where('client_id','=',$appointment->client_id);
        $q->where('start_time','>',$users->start_time);

    })->sum('used_pulse');

return [$users , $pulseSum];

}
    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Inventory::where('id', Auth::user()->branch_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $appointment->load('client', 'doctor', 'services', 'products', 'branch');

        return view('frontend.appointments.edit', compact('clients', 'doctors', 'services', 'products', 'branches', 'appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {

        $last = Appointment::where('branch_id',$request->branch_id)->max('pulse');
        $appointment->update(['used_pulse'=> ($request->pulse - $last) ]);
        $appointment->update($request->all());

        if (isset($request->appointment->services)) {
            $appointment->services()->sync($request->input('services', []));
            $appointment->products()->sync($request->input('products', []));
        }

        Income::firstorCreate([
            'entry_date' => Carbon::now()->toDateString(),
            'amount'=>$request->price,
            'description'=>'Paied by customer',
            'income_category_id'=>1,
            'cs_name_id'=>$request->client_id ,
            'branch_id'=> Auth::user()->branch_id ,
        ]);

        return redirect()->route('frontend.appointments.today');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('client', 'doctor', 'services', 'products', 'branch');

        return view('frontend.appointments.show', compact('appointment'));
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
