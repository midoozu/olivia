@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $appointment->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $appointment->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <span class="text-danger">{{ $errors->first('doctor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $appointment->start_time) }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}</label>
                <input class="form-control datetime {{ $errors->has('finish_time') ? 'is-invalid' : '' }}" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time', $appointment->finish_time) }}" required>
                @if($errors->has('finish_time'))
                    <span class="text-danger">{{ $errors->first('finish_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.finish_time_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="price">{{ trans('cruds.appointment.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $appointment->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', $appointment->comment) }}">
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="services">{{ trans('cruds.appointment.fields.services') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services[]" id="services" multiple required>
                    @foreach($services as $id => $service)
                        <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $appointment->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                    <span class="text-danger">{{ $errors->first('services') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.services_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="products">{{ trans('cruds.appointment.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (in_array($id, old('products', [])) || $appointment->products->contains($id)) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pulse">{{ trans('cruds.appointment.fields.pulse') }}</label>
                <input class="form-control {{ $errors->has('pulse') ? 'is-invalid' : '' }}" type="number" name="pulse" id="pulse" value="{{ old('pulse', $appointment->pulse) }}" step="1">
                @if($errors->has('pulse'))
                    <span class="text-danger">{{ $errors->first('pulse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.pulse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                <select class="form-control select2 {{ $errors->has('branch') ? 'is-invalid' : '' }}" name="branch_id" id="branch_id">
                    @foreach($branches as $id => $entry)
                        <option value="{{ $id }}" {{ (old('branch_id') ? old('branch_id') : $appointment->branch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('branch'))
                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('follow_up') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="follow_up" value="0">
                    <input  type="checkbox" name="follow_up" id="follow_up" value="1" {{ $appointment->follow_up || old('follow_up', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="follow_up">{{ trans('cruds.appointment.fields.follow_up') }}</label>
                </div>
                @if($errors->has('follow_up'))
                    <span class="text-danger">{{ $errors->first('follow_up') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.follow_up_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('check_in') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="check_in" value="0">
                    <input  type="checkbox" name="check_in" id="check_in" value="1" {{ $appointment->check_in || old('check_in', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="check_in">{{ trans('cruds.appointment.fields.check_in') }}</label>
                </div>
                @if($errors->has('check_in'))
                    <span class="text-danger">{{ $errors->first('check_in') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.check_in_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('check_out') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="check_out" value="0">
                    <input  type="checkbox" name="check_out" id="check_out" value="1" {{ $appointment->check_out || old('check_out', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="check_out">{{ trans('cruds.appointment.fields.check_out') }}</label>
                </div>
                @if($errors->has('check_out'))
                    <span class="text-danger">{{ $errors->first('check_out') }}</span>
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



@endsection
