@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.att.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.atts.update", [$att->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.att.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $att->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.att.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="value">{{ trans('cruds.att.fields.value') }}</label>
                            <input class="form-control" type="text" name="value" id="value" value="{{ old('value', $att->value) }}">
                            @if($errors->has('value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.att.fields.value_helper') }}</span>
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
