@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                            <input class="form-control datetime " type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                            @if($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="required" for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}</label>--}}
{{--                            <input class="form-control datetime" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time') }}" required>--}}
{{--                            @if($errors->has('finish_time'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('finish_time') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <span class="help-block">{{ trans('cruds.appointment.fields.finish_time_helper') }}</span>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="weight">{{ trans('cruds.appointment.fields.invoice') }}</label>
                            <input class="form-control" type="number" name="weight" id="weight" value="{{ old('invoice', '') }}">
                            @if($errors->has('invoice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.invoice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="power">{{ trans('cruds.appointment.fields.power') }}</label>
                            <input class="form-control" type="number" name="power" id="power" value="{{ old('power', '') }}">
                            @if($errors->has('power'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('power') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.power_helper') }}</span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="circum">{{ trans('cruds.appointment.fields.circum') }}</label>--}}
{{--                            <input class="form-control" type="text" name="circum" id="circum" value="{{ old('circum', '') }}">--}}
{{--                            @if($errors->has('circum'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('circum') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <span class="help-block">{{ trans('cruds.appointment.fields.circum_helper') }}</span>--}}
{{--                        </div>--}}
                        @can('reception_role')
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.appointment.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.price_helper') }}</span>
                        </div>
                        @endcan
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
                            <label class="required" for="services">{{ trans('cruds.appointment.fields.services') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="services[]" id="services" multiple required>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('services') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.services_helper') }}</span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="products">{{ trans('cruds.appointment.fields.product') }}</label>--}}
{{--                            <div style="padding-bottom: 4px">--}}
{{--                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>--}}
{{--                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>--}}
{{--                            </div>--}}
{{--                            <select class="form-control select2" name="products[]" id="products" multiple>--}}
{{--                                @foreach($products as $id => $product)--}}
{{--                                    <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->has('products'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('products') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <span class="help-block">{{ trans('cruds.appointment.fields.product_helper') }}</span>--}}
{{--                        </div>--}}
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
                            <label for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                            <select class="form-control select2" name="branch_id" id="branch_id">
                                    <option value="{{Auth::user()->branch->id}}">{{Auth::user()->branch->name}}</option>
                            </select>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="follow_up" value="0">
                                <input type="checkbox" name="follow_up" id="follow_up" value="1" {{ old('follow_up', 0) == 1 ? 'checked' : '' }}>
                                <label for="follow_up">{{ trans('cruds.appointment.fields.follow_up') }}</label>
                            </div>
                            @if($errors->has('follow_up'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('follow_up') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.follow_up_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="check_in" value="0">
                                <input type="checkbox" name="check_in" id="check_in" value="1" {{ old('check_in', 0) == 1 ? 'checked' : '' }}>
                                <label for="check_in">{{ trans('cruds.appointment.fields.check_in') }}</label>
                            </div>
                            @if($errors->has('check_in'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('check_in') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.check_in_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="check_out" value="0">
                                <input type="checkbox" name="check_out" id="check_out" value="1" {{ old('check_out', 0) == 1 ? 'checked' : '' }}>
                                <label for="check_out">{{ trans('cruds.appointment.fields.check_out') }}</label>
                            </div>
                            @if($errors->has('check_out'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('check_out') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.check_out_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
