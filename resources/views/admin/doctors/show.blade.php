@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.doctor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <form method="POST" action="{{ route("admin.doctors.calcpercentage",$doctor->id) }}" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ "حساب" }}
                    </button>
                </div>
            </form>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.id') }}
                        </th>
                        <td>
                            {{ $doctor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.name') }}
                        </th>
                        <td>
                            {{ $doctor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.email') }}
                        </th>
                        <td>
                            {{ $doctor->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.photo') }}
                        </th>
                        <td>
                            @foreach($doctor->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.phone') }}
                        </th>
                        <td>
                            {{ $doctor->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.services') }}
                        </th>
                        <td>
                            @foreach($doctor->services as $key => $services)
                                <span class="label label-info">{{ $services->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.min_amount') }}
                        </th>
                        <td>
                            {{ $doctor->min_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'مستحق اليوم' }}
                        </th>
                        <td>
                            {{ $doctorpercent }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
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
            <a class="nav-link" href="#doctor_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="doctor_appointments">
            @includeIf('admin.doctors.relationships.doctorAppointments', ['appointments' => $doctor->doctorAppointments])
        </div>
    </div>
</div>

@endsection
