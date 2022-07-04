@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.products.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.product.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="size_id">{{ trans('cruds.product.fields.size') }}</label>
                            <select class="form-control select2" name="size_id" id="size_id">
                                @foreach($sizes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('size_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('size'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('size') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.size_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="qty">{{ trans('cruds.product.fields.qty') }}</label>
                            <input class="form-control" type="text" name="qty" id="qty" value="{{ old('qty', '') }}" required>
                            @if($errors->has('qty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.qty_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="categories[]" id="categories" multiple>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categories'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('categories') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="atts">{{ trans('cruds.product.fields.att') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="atts[]" id="atts" multiple>
                                @foreach($atts as $id => $att)
                                    <option value="{{ $id }}" {{ in_array($id, old('atts', [])) ? 'selected' : '' }}>{{ $att }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('atts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('atts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.att_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="inv_name_id">{{ trans('cruds.product.fields.inv_name') }}</label>
                            <select class="form-control select2" name="inv_name_id" id="inv_name_id" required>
                                @foreach($inv_names as $id => $entry)
                                    <option value="{{ $id }}" {{ old('inv_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('inv_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inv_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.inv_name_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.products.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->photo)
      var file = {!! json_encode($product->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
