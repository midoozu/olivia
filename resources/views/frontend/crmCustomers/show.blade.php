@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.crmCustomer.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.crm-customers.index') }}">
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
                                        {{ $crmCustomer->due_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.crmCustomer.fields.paid_amount') }}
                                    </th>
                                    <td>
                                        {{ $crmCustomer->paid_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.crmCustomer.fields.required_amount') }}
                                    </th>
                                    <td>
                                        {{ $crmCustomer->required_amount }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.crm-customers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
