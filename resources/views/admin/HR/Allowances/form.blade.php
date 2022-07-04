

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
    <li class="breadcrumb-item "><a href="{{route('admin.HRAllowances.index')}}"> البدلات</a></li>



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

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">الإسم</label>
                    <input type="text" name="title"  value="{{isset($row_data)?$row_data->title:old('title')}}" class="form-control" data-validation="required">
                    @error('title')
                        {{$message}}
                    @enderror
                </div>



                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">القيمة</label>
                    <input type="text" name="value"  value="{{isset($row_data)?$row_data->value:old('value')}}" class="form-control" data-validation="required">
                    @error('value')
                        {{$message}}
                    @enderror
                </div>

                <div class="w-100 pb-3 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-secondary"> حفظ </button>
                </div>

            </div>
        </form>

    </section>
@endsection
