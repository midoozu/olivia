@extends('layouts.frontend.app', ['activePage' => 'appointments', 'titlePage' => __('appointments')])


@section('content')

    <div class="content">
        <div class="container-fluid " >

            @can('appointment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12" >
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#createAppointment"  >{{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createCustomer">{{"اضافه عميل"}}</button>
                        <button type="button" class="btn btn-success">{{"اضافه مصاريف"}}</button>
                        <button type="button" class="btn btn-danger">{{"تسليم الايراد"}}</button>
                        <button type="button" class="btn btn-warning">{{" اجمالي كاش "}}</button>
                        <button type="button" class="btn btn-default">{{"اجمالي فيزا "}}</button>

                    </div>
                </div>

                <div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{"اضافه عميل"}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route("frontend.crm-customers.new") }}" enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf

                                    <div class="form-group">
                                        <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                                        <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                                        @if($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('first_name') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                                        <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                                        @if($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.crmCustomer.fields.phone_helper') }}</span>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal fade" id="createAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{"اضافه حجز"}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf

                                    <div class="form-group">
                                        <label class="required" for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                                        <input list="ice-cream-flavors" id="client_id" name="client_id" />
                                        <datalist id="ice-cream-flavors">
                                            @foreach($clients as $id => $entry)
                                                <option value="{{ $entry->id }}">{{ $entry->phone }} {{$entry->first_name}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                                        <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                            @foreach($doctors as $id => $entry)
                                                <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('doctor'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('doctor') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                                        <input class="form-control datetime " type="text" name="start_time" id="start_time" value="{{ now() }}" required>
                                        @if($errors->has('start_time'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('start_time') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
                                    </div>

                                    <div class="form-group" >
                                        <label class="required" for="services">{{ trans('cruds.appointment.fields.services') }}</label>
                                        <select  class="form-control  select2" name="services[]" id="services"  multiple required>
                                            @foreach($services as $id => $service)
                                                <option  value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('services'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('services') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.appointment.fields.services_helper') }}</span>
                                    </div>
                                    <input type="text" value="{{Auth::user()->branch->id}}" name="branch_id" id="branch_id" hidden>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            @endcan

       <div class="card-body" >
           <div class="row">
               <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-warning">
                           {{' الحجوزات'}}
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item"  style="text-align: right "> <a  href="{{route('frontend.appointments.today')}}">جلسات اليوم </a> </li>
                           <li class="list-group-item" style="text-align: right"><a href="{{route('frontend.appointments.tomorrow')}}">{{"جلسات
                               الغد"}}</a> </li>
                           <li class="list-group-item" style="text-align: right"><a href="{{route('frontend.appointments.index')}}"> {{"جميع الحجوزات"}}</a> </li>
                       </ul>
                   </div>
               </div>

               <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-info">
                           العملاء
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">اضافه عميل</li>
                           <li class="list-group-item">بحث عن عميل</li>
                           <li class="list-group-item"><a href="{{route('frontend.crm-customers.index')}}">{{'جميع العملاء'}}</a></li>
                       </ul>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-danger">
                           Featured
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">Cras justo odio</li>
                           <li class="list-group-item">Dapibus ac facilisis in</li>
                           <li class="list-group-item">Vestibulum at eros</li>
                       </ul>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-warning">
                           Featured
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">Cras justo odio</li>
                           <li class="list-group-item">Dapibus ac facilisis in</li>
                           <li class="list-group-item">Vestibulum at eros</li>
                       </ul>
                   </div>
               </div>

               <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-info">
                           Featured
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">Cras justo odio</li>
                           <li class="list-group-item">Dapibus ac facilisis in</li>
                           <li class="list-group-item">Vestibulum at eros</li>
                       </ul>
                   </div>
               </div> <div class="col-md-4">
                   <div class="card card-nav-tabs" style="width: 20rem;">
                       <div class="card-header card-header-danger">
                           Featured
                       </div>
                       <ul class="list-group list-group-flush">
                           <li class="list-group-item">Cras justo odio</li>
                           <li class="list-group-item">Dapibus ac facilisis in</li>
                           <li class="list-group-item">Vestibulum at eros</li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#services').select2({
            dropdownParent: $('#createAppointment')
        });
        $('#doctor_id').select2({
            dropdownParent: $('#createAppointment')
        });
    </script>

@endpush

