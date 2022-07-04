@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.crmCustomer.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.crm-customers.update", [$crmCustomer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', $crmCustomer->first_name) }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="gov">{{ trans('cruds.crmCustomer.fields.gov') }}</label>
                            <input class="form-control" type="text" name="gov" id="gov" value="{{ old('gov', $crmCustomer->gov) }}" required>
                            @if($errors->has('gov'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gov') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.gov_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $crmCustomer->address) }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $crmCustomer->phone) }}" required>
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_2">{{ trans('cruds.crmCustomer.fields.phone_2') }}</label>
                            <input class="form-control" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', $crmCustomer->phone_2) }}">
                            @if($errors->has('phone_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $crmCustomer->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="website">{{ trans('cruds.crmCustomer.fields.website') }}</label>
                            <input class="form-control" type="text" name="website" id="website" value="{{ old('website', $crmCustomer->website) }}">
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.website_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.crmCustomer.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $crmCustomer->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.crmCustomer.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cus_status_id">{{ trans('cruds.crmCustomer.fields.cus_status') }}</label>
                            <select class="form-control select2" name="cus_status_id" id="cus_status_id">
                                @foreach($cus_statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('cus_status_id') ? old('cus_status_id') : $crmCustomer->cus_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cus_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cus_status') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection
