@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.inventory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inventories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.inventory.fields.id') }}
                        </th>
                        <td>
                            {{ $inventory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inventory.fields.name') }}
                        </th>
                        <td>
                            {{ $inventory->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inventories.index') }}">
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
            <a class="nav-link" href="#inv_name_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#branch_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#branch_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#branch_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#branch_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="inv_name_products">
            @includeIf('admin.inventories.relationships.invNameProducts', ['products' => $inventory->invNameProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="branch_users">
            @includeIf('admin.inventories.relationships.branchUsers', ['users' => $inventory->branchUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="branch_expenses">
            @includeIf('admin.inventories.relationships.branchExpenses', ['expenses' => $inventory->branchExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="branch_incomes">
            @includeIf('admin.inventories.relationships.branchIncomes', ['incomes' => $inventory->branchIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="branch_appointments">
            @includeIf('admin.inventories.relationships.branchAppointments', ['appointments' => $inventory->branchAppointments])
        </div>
    </div>
</div>

@endsection
