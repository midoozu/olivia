<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrmCustomerController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomers = CrmCustomer::with(['cus_status'])->get();

        return view('frontend.crmCustomers.index', compact('crmCustomers'));
    }

    public function create()
    {
        abort_if(Gate::denies('crm_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cus_statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.crmCustomers.create', compact('cus_statuses'));
    }
public function new(StoreCrmCustomerRequest $request){

    $crmCustomer = CrmCustomer::create($request->all());

        toastr()->success('تم الاضافه بنجاح');

        return redirect()->back();
}
    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        return redirect()->route('frontend.crm-customers.index');
    }

    public function edit(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cus_statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crmCustomer->load('cus_status');

        return view('frontend.crmCustomers.edit', compact('cus_statuses', 'crmCustomer'));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $crmCustomer->update($request->all());

        return redirect()->route('frontend.crm-customers.index');
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->load('cus_status', 'csNameIncomes', 'csExpensesExpenses', 'clientAppointments');

        return view('frontend.crmCustomers.show', compact('crmCustomer'));
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrmCustomerRequest $request)
    {
        CrmCustomer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
