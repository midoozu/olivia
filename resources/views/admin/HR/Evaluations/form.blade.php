

@extends('layouts.admin.admin')
@section('styles')
<style>
    .allowance_div{
        /*display: none;*/
    }
</style>
@endsection

@section('page-title')
    {{$page_title}}
@endsection

@section('current-page-name')

    {{$page_title}}
@endsection

@section('page-links')
    <li class="breadcrumb-item "><a href="{{route('admin.HREmployeeEvaluations.index')}}"> التقييمات</a></li>



@endsection

@section('content')

    <section class="items-add-page my-3 py-4" style="background-color: white;padding: 10px">

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
                    <label class="label mb-2 ">الوظيفة</label>
                    <select name="job_id" class="form-control">
                        @foreach($jobs as $job)
                            <option value="{{$job->id}}" {{isset($row_data)&&$row_data->job_id == $job->id ? 'selected' : ''}} > {{$job->title}}</option>
                        @endforeach
                    </select>
                    @error('job_id')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">العنوان</label>
                    <input type="text" name="title"  value="{{isset($row_data)?$row_data->title:old('title')}}" class="form-control" data-validation="required">
                    @error('title')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">التفاصيل</label>
                    <textarea  name="details"  class="form-control" data-validation="required">{{isset($row_data)?$row_data->details:old('details')}}</textarea>
                    @error('details')
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


@section('js')

@endsection
