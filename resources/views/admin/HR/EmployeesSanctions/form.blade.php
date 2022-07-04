

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
    <li class="breadcrumb-item "><a href="{{route('admin.HREmployeeSanctions.index')}}"> جزاءات الموظفين</a></li>



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
                    <label class="label mb-2 ">الجزاء</label>
                    <select name="sonction_id" class="form-control select2">
                        @foreach($sanctions as $sanction)
                            <option value="{{$sanction->id}}" {{isset($row_data) && $row_data->sanction_id == $sanction->id?'selected':''}} >{{$sanction->title}}</option>
                        @endforeach
                    </select>
                    @error('sonction_id')
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
                    <label class="label mb-2 ">التاريخ</label>
                    <input type="month" name="month" class="form-control" value="{{isset($row_data)?$row_data->year.'-'.$row_data->month:old('month')}}" />
                    @error('month')
                        {{$message}}
                    @enderror
                </div>



                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">القيمة</label>
                    <input type="text" name="value" class="form-control" value="{{isset($row_data)?$row_data->value:old('value')}}" />
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
