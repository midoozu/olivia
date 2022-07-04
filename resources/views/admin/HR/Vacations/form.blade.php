

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
    <li class="breadcrumb-item "><a href="{{route('admin.HREmployeeVacations.index')}}"> الإجازات</a></li>



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
                    <label class="label mb-2 ">الإجازة</label>
                    <select name="vacation_id" class="form-control select2">
                        @foreach($vacations as $vacation)
                            <option value="{{$vacation->id}}" {{isset($row_data) && $row_data->vacation_id == $vacation->id?'selected':''}} >{{$vacation->title}}</option>
                        @endforeach
                    </select>
                    @error('vacation_id')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">الموظف</label>
                    <select name="employee_id" class="form-control select2">
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}" {{isset($row_data) && $row_data->employee_id == $employee->id?'selected':''}} >{{$employee->name}}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        {{$message}}
                    @enderror
                </div>


                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">تاريخ البداية</label>
                    <input type="date" name="from_date"  value="{{isset($row_data)?$row_data->from_date:old('from_date')}}" class="form-control" data-validation="required">
                    @error('from_date')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">تاريخ النهاية</label>
                    <input type="date" name="to_date"  value="{{isset($row_data)?$row_data->to_date:old('to_date')}}" class="form-control" data-validation="required">
                    @error('to_date')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">سبب الإجازة</label>
                    <textarea name="reason" class="form-control">{{isset($row_data)?$row_data->reason:old('reason')}}</textarea>
                    @error('reason')
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
