@extends('layouts.frontend.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.appointment.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.appointment.fields.client') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.crmCustomer.fields.phone') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.appointment.fields.doctor') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.appointment.fields.start_time') }}
                                        </th>

                                        <th>
                                            {{ trans('cruds.appointment.fields.price') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.appointment.fields.comment') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.appointment.fields.services') }}
                                        </th>


                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($appointments as $key => $appointment)
                                        @if($appointment->check_out != 1)
                                        <tr data-entry-id="{{ $appointment->id }}">

                                            <td>
                                                {{ $appointment->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $appointment->client->first_name ?? '' }}
                                            </td>

                                            <td>
                                                {{ $appointment->client->phone ?? '' }}
                                            </td>
                                            <td>
                                                {{ $appointment->doctor->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $appointment->start_time ?? '' }}
                                            </td>

                                            <td>
                                                {{ $appointment->price ?? '' }}
                                            </td>
                                            <td>
                                                {{ $appointment->comment ?? '' }}
                                            </td>
                                            <td>
                                                @foreach($appointment->services as $key => $item)

                                                    <span class="badge badge-info">{{ $item->name }}</span>
                                                    <span class="badge badge-warning ">{{ count([$item]) }}</span>
                                                    <span class="badge badge-danger ">{{ $item->price }}</span>
                                                @endforeach

                                            </td>
                                        <td class="td-actions text-right">
                                                @can('appointment_show')
                                                    <button class="btn btn-primary btn-sm" href="{{ route('frontend.appointments.show', $appointment->id) }}">
                                                        {{ trans('global.view') }}
                                                    </button>
                                                @endcan
                                                @can('appointment_edit')
                                                    <a class="btn btn-info btn-sm" href="{{ route('frontend.appointments.edit', $appointment->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('appointment_delete')
                                                    <form action="{{ route('frontend.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan
                                                    <a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#entry">
                                                        {{ "حضور"  }}
                                                    </a>
                                                    <a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#exit">
                                                        {{  " خروج"}}
                                                    </a>

                                                    <a class="btn btn-default btn-sm" >
                                                        {{  " متابعه"}}
                                                    </a>
                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
{{--    --}}
{{--    modal start --}}
    <div class="modal fade" id="entry" tabindex="-1" role="dialog" aria-labelledby="entry" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entry">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route("frontend.appointments.entry", [$appointment->id])}}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

{{--                        <div class="form-group">--}}
{{--                            <label class="required" for="services">{{ trans('cruds.appointment.fields.services') }}</label>--}}
{{--                            <select class="form-control select2" name="services[]" id="services" multiple required>--}}
{{--                                @foreach($services as $id => $service)--}}
{{--                                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $appointment->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->has('services'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('services') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <span class="help-block">{{ trans('cruds.appointment.fields.services_helper') }}</span>--}}
{{--                        </div>--}}


                        <div class="form-check form-check-radio col-2 " >
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="cash" checked required>
                                {{"كاش"}}
                                <span class="circle">
                                      <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <div class="form-check form-check-radio   col-2  ">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="visa" >
                                {{"فيزا"}}
                                <span class="circle">
                              <span class="check"></span>
                        </span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="price">{{ trans('cruds.appointment.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="discount">{{ "الخصم" }}</label>
                            <input class="form-control" type="number" name="discount" id="discount" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.price_helper') }}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route("frontend.appointments.update", [$appointment->id ?? '']) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                            <input class="form-control" type="text" name="comment" id="comment" value="{{ old('comment', '') }}">
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pulse">{{ trans('cruds.appointment.fields.pulse') }}</label>
                            <input class="form-control" type="number" name="pulse" id="pulse" value="{{ old('pulse', '') }}" step="1">
                            @if($errors->has('pulse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pulse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.pulse_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pulse">{{ " بلص اضافي" }}</label>
                            <input class="form-control" type="number" name="pulse" id="pulse" value="{{ old('pulse', '') }}" step="1">
                            @if($errors->has('pulse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pulse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.pulse_helper') }}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>

                        <input type="text" name="check_out" id="check_out" value="1" hidden>

                    </form>

                </div>

            </div>
        </div>
    </div>


    {{--    modal end --}}
@endsection
