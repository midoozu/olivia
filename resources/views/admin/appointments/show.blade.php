@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.client') }}
                        </th>
                        <td>
                            {{ $appointment->client->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.doctor') }}
                        </th>
                        <td>
                            {{ $appointment->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.start_time') }}
                        </th>
                        <td>
                            {{ $appointment->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $appointment->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.price') }}
                        </th>
                        <td>
                            {{ $appointment->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.comment') }}
                        </th>
                        <td>
                            {{ $appointment->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.services') }}
                        </th>
                        <td>
                            @foreach($appointment->services as $key => $services)
                                <span class="label label-info">{{ $services->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.product') }}
                        </th>
                        <td>
                            @foreach($appointment->products as $key => $product)
                                <span class="label label-info">{{ $product->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.pulse') }}
                        </th>
                        <td>
                            {{ $appointment->pulse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.branch') }}
                        </th>
                        <td>
                            {{ $appointment->branch->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.follow_up') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointment->follow_up ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.check_in') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointment->check_in ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.check_out') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointment->check_out ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
