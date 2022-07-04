@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.doctor.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', '') }}" step="1" required>
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="min_amount">{{ trans('cruds.doctor.fields.min_amount') }}</label>
                <input class="form-control {{ $errors->has('min_amount') ? 'is-invalid' : '' }}" type="number" name="min_amount" id="min_amount" value="{{ old('min_amount', '') }}" step="0.01" required>
                @if($errors->has('min_amount'))
                    <span class="text-danger">{{ $errors->first('min_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.min_amount_helper') }}</span>
            </div>

            <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                        <th> {{'service id '}}</th>
                        <th>{{'service name'}}</th>
                        <th>{{' doctor pecent'}}</th>
                        </thead>
                        <tbody>
                        @foreach($services as $id => $service)
                        <tr>
                            <td><input id="service_id[]" name="service_id[]" type="text" value="{{$id}}" style="border: none"> </td>
                            <td><input type="text" value="{{$service }}" style="border: none" ></td>
                            <td><input id="doctor_price[]" name="doctor_price[]" type="number" value=""></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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

@section('scripts')
<script>
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.doctors.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($doctor) && $doctor->photo)
      var files = {!! json_encode($doctor->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
        }
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
