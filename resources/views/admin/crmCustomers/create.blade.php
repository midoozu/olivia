@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.crmCustomer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-customers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gov">{{ trans('cruds.crmCustomer.fields.gov') }}</label>
                <input class="form-control {{ $errors->has('gov') ? 'is-invalid' : '' }}" type="text" name="gov" id="gov" value="{{ old('gov', '') }}" required>
                @if($errors->has('gov'))
                    <span class="text-danger">{{ $errors->first('gov') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.gov_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.crmCustomer.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', '') }}">
                @if($errors->has('phone_2'))
                    <span class="text-danger">{{ $errors->first('phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.crmCustomer.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.crmCustomer.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cus_status_id">{{ trans('cruds.crmCustomer.fields.cus_status') }}</label>
                <select class="form-control select2 {{ $errors->has('cus_status') ? 'is-invalid' : '' }}" name="cus_status_id" id="cus_status_id">
                    @foreach($cus_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('cus_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cus_status'))
                    <span class="text-danger">{{ $errors->first('cus_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.cus_status_helper') }}</span>
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
