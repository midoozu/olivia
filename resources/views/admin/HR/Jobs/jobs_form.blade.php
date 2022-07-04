

@extends('layouts.admin.admin')
@section('styles')

@endsection

@section('page-title')
    {{$page_title}}
@endsection

@section('current-page-name')

    {{$page_title}}
@endsection

@section('page-links')
    <li class="breadcrumb-item "><a href="{{route('admin.HRJobs.index')}}"> شئون الموظفين</a></li>



@endsection

@section('content')
    <section class="items-add-page my-3 py-4" style="background-color: white;">

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{Session::get('success')}}
            </div>
        @endif

        <form action="{{$form_action}}" enctype="multipart/form-data" method="POST">
            @csrf
            @if(isset($row_data))
                @method('PUT')
            @endif
            <div class="row">

                <div class="col-lg-12 col-md-12  mb-4">
                    <label class="label mb-2 ">الإسم</label>
                    <input required type="text" name="title"  value="{{isset($row_data)?$row_data->title:old('title')}}" class="form-control" data-validation="required">
                    @error('title')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12  mb-4">
                    <label class="label mb-2 ">القسم</label>
                    <select required name="department_id" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" {{isset($row_data)&&$row_data->department_id == $department->id ? 'selected' : ''}} > {{$department->title}}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12  mb-4">
                    <label class="label mb-2 ">الحد الأدنى للراتب</label>
                    <input type="text" required name="min_salary"  value="{{isset($row_data)?$row_data->min_salary:old('min_salary')}}" class="form-control" data-validation="required">
                    @error('min_salary')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12  mb-4">
                    <label class="label mb-2 ">الحد الأقصى للراتب</label>
                    <input type="text" required name="max_salary"  value="{{isset($row_data)?$row_data->max_salary:old('max_salary')}}" class="form-control" data-validation="required">
                    @error('max_salary')
                        {{$message}}
                    @enderror
                </div>

                @if(isset($row_data))
                    <input type="hidden" name="id" value="{{$row_data->id}}" />
                @endif

                <div class="w-100 pb-3 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-secondary"> حفظ </button>
                </div>

            </div>
        </form>

    </section>
@endsection
