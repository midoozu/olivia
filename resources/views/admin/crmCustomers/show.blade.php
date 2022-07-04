@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crmCustomer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.id') }}
                        </th>
                        <td>
                            {{ $crmCustomer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.gov') }}
                        </th>
                        <td>
                            {{ $crmCustomer->gov }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.address') }}
                        </th>
                        <td>
                            {{ $crmCustomer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.phone') }}
                        </th>
                        <td>
                            {{ $crmCustomer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $crmCustomer->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.email') }}
                        </th>
                        <td>
                            {{ $crmCustomer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.website') }}
                        </th>
                        <td>
                            {{ $crmCustomer->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.cus_status') }}
                        </th>
                        <td>
                            {{ $crmCustomer->cus_status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.due_amount') }}
                        </th>
                        <td>
                            {{ $dueAmount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.paid_amount') }}
                        </th>
                        <td>
                            {{ $paidAmount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.required_amount') }}
                        </th>
                        <td>
                            {{ $requiredPay }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#cs_name_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#cs_expenses_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="cs_name_incomes">
            @includeIf('admin.crmCustomers.relationships.csNameIncomes', ['incomes' => $crmCustomer->csNameIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="cs_expenses_expenses">
            @includeIf('admin.crmCustomers.relationships.csExpensesExpenses', ['expenses' => $crmCustomer->csExpensesExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_appointments">
            @includeIf('admin.crmCustomers.relationships.clientAppointments', ['appointments' => $crmCustomer->clientAppointments])
        </div>
    </div>
</div>

@endsection
