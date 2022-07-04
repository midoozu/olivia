

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
    <li class="breadcrumb-item "><a href="{{route('admin.HREmployee.index')}}"> شئون الموظفين</a></li>



@endsection

@section('content')

    <section class="items-add-page my-3 py-4" style="background-color: white;padding: 20px">

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
                    <input type="text" name="name"  value="{{isset($row_data)?$row_data->name:old('name')}}" class="form-control" data-validation="required">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">البريد الإلكترونى</label>
                    <input type="text" name="email"  value="{{isset($row_data)?$row_data->email:old('email')}}" class="form-control" data-validation="required">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">رقم التليفون</label>
                    <input type="text" name="phone"  value="{{isset($row_data)?$row_data->phone:old('phone')}}" class="form-control" data-validation="required">
                    @error('phone')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">رقم التليفون  اّخر</label>
                    <input type="text" name="other_phone"  value="{{isset($row_data)?$row_data->other_phone:old('other_phone')}}" class="form-control" >
                    @error('other_phone')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">القسم</label>
                    <select name="department_id" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" {{isset($row_data)&&$row_data->department_id == $department->id ? 'selected' : ''}} > {{$department->title}}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        {{$message}}
                    @enderror
                </div>

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
                    <label class="label mb-2 ">الراتب</label>
                    <input type="text" name="salary"  value="{{isset($row_data)?$row_data->salary:old('salary')}}" class="form-control" data-validation="required">
                    @error('salary')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">نسبة العمولة</label>
                    <input type="text" name="commission_per"  value="{{isset($row_data)?$row_data->commission_per:old('commission_per')}}" class="form-control" />
                    @error('commission_per')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">نسبة التأمينات</label>
                    <input type="text" name="insurances_per"  value="{{isset($row_data)?$row_data->insurances_per:old('insurances_per')}}" class="form-control" />
                    @error('insurances_per')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">نسبة الضرائب</label>
                    <input type="text" name="tax_per"  value="{{isset($row_data)?$row_data->tax_per:old('tax_per')}}" class="form-control" />
                    @error('tax_per')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">العنوان</label>
                    <textarea name="address" class="form-control">{{isset($row_data)?$row_data->tax_per:old('tax_per')}}</textarea>
                    @error('address')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">CV</label>
                    <input type="file" name="cv" class="form-control " data-default-file="{{isset($row_data)?Storage::url('uploads/'.$row_data->cv):old('cv')}}" />
                    @if(isset($row_data) && $row_data->cv!='')
                        <a href="{{Storage::url('uploads/'.$row_data->cv)}}" download>تحميل الملف</a>
                    @endif

                    @error('cv')
                        {{$message}}
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4  mb-4">
                    <label class="label mb-2 ">الصورة</label>
                    <input type="file" name="image" class="form-control dropify" data-default-file="{{isset($row_data)?Storage::url('uploads/'.$row_data->image):old('image')}}" />
                    @error('image')
                        {{$message}}
                    @enderror
                </div>
                <div class="col-lg-4 col-md-4  mb-4"></div>



                {{--------------ALLOWANCES---------------}}

                <div class="col-lg-12 col-md-12  mb-12"><h2>البدلات</h2></div>
                @if(isset($row_data) && count($row_data->allowances) != 0)

                @forelse($row_data->allowances as $index=>$emp_allow)
                    <div class="row allowance_row allowance_row_{{$index}}">
                        <div class="col-lg-4 col-md-4  mb-4">
                            <label class="label mb-2 ">البدلات</label>
                            <select name="allowances[]" class="form-control allowance allowance_id_{{$index}}" data-index=0>
                                <option>--أختر--</option>
                                @foreach($allowances as $id=>$allow)
                                    <option value="{{$id}}" {{$emp_allow->allowance_id == $id?'selected':'disabled'}}> {{$allow->title}}</option>
                                @endforeach
                            </select>
                            @error('allowances')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-4  mb-4 allowance_div" >
                            <label class="label mb-2 ">القيمة</label>
                            <input name="allowance_val[]" value="{{$emp_allow->value}}" id="" class="form-control allowance_val_{{$index}}"  />


                        </div>

                        <div class="col-lg-4 col-md-4  mb-4 allowance_div" >
                            <a class="btn btn-info update_allowance" data-update_index={{$index}} >تحديث</a>
                            @if($index == 0)
                                <a class="btn btn-success add_allowance"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            @else
                                <a class="btn btn-danger remove_allowance" data-remove_index={{$index}}><i class="fa fa-trash" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                @empty


                @endforelse
                @else
                    <div class="row allowance_row">
                        <div class="col-lg-4 col-md-4  mb-4">
                            <label class="label mb-2 ">البدلات</label>
                            <select name="allowances[]" class="form-control allowance allowance_id_0" data-index=0>
                                <option>--أختر--</option>
                                @foreach($allowances as $id=>$allow)
                                    <option value="{{$id}}" > {{$allow->title}}</option>
                                @endforeach
                            </select>
                            @error('allowances')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-4  mb-4 allowance_div" >
                            <label class="label mb-2 ">القيمة</label>
                            <input name="allowance_val[]" value="" id="" class="form-control allowance_val_0"  />


                        </div>

                        <div class="col-lg-4 col-md-4  mb-4 allowance_div" >
                            <a class="btn btn-info update_allowance" data-update_index=0 >تحديث</a>
                            <a class="btn btn-success add_allowance"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endif

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


@section('scripts')
<script>

    $('body').on('change', '.allowance', function(e) {
        var allowance_id = $(this, ".allowance option:selected" ).val();
        var index = $(this).data('index');

        //check allowance id not exist before
        var selected_allowances = $('.allowance').map(function(idx, elem) {
            return $(elem ).val();
          }).get();

        //show allowance inputs
        $('.allowance_div').show();


        //show value input
        var allow_arr = <?php echo json_encode($allowances);?>;
        var allowance_value = allow_arr[allowance_id]['value'];
        $('.allowance_val_'+index).val(allowance_value);

    });


    //update_allowance
    $('body').on('click', '.update_allowance', function(e) {
        e.preventDefault();

        //update button index
        var update_index = $(this).data('update_index');

        //new allowance value
        new_val = $('.allowance_val_'+update_index).val();

        //selected allowance id
        allowance_id = $('.allowance_id_'+update_index + ' option:selected').val();

        postData = {
            allowance_id: allowance_id,
            value: new_val,
            _token: "{{csrf_token()}}"
        };
        $.post('{{route("admin.update_allowance")}}', postData, function(result){
            if(result['status']=='success')
            {
                toastr.success(' تم تحديث البدل بنجاح','تنبيه!!')
                // myToast(' تم تحديث البدل بنجاح','تنبيه','buttom-left', '#ff6849', 'success',4000, 2)
            }
            else
            {
                toastr.error(' حدث خطأ أثناء تحديث البدل','تنبيه!!')

                // myToast(' حدث خطأأثناء تحديث البدل','تنبيه','buttom-left', '#ff6849', 'error',4000, 2)
            }
        });
    });


    //add_allowance
    $('body').on('click', '.add_allowance', function(e) {
        e.preventDefault();

        //selected allowances
         var selected_allowances = $('.allowance').map(function(idx, elem) {
            return $(elem ).val();
          }).get();


        //console.log(selected_allowances);

        max_index = 0;
        $('.allowance').each(function() {
          var value = parseInt($(this).data('index'));
          max_index = (value > max_index) ? value : max_index;
        });


        var new_index = max_index + 1;
        var allowances = <?php echo json_encode($allowances);?> // allowances array

        //select allowance input
        var appended_div = '<div class="row allowance_row_'+new_index+' allowance_row"><div class="col-lg-4 col-md-4  mb-4"> <label class="label mb-2 ">البدلات</label> <select name="allowances[]" class="form-control allowance allowance_id_'+new_index+'" data-index="'+new_index+'">';
        appended_div += '<option>--أختر--</option>';


        $.each( allowances, function( index, allow ){
            if( jQuery.inArray(index, selected_allowances) === -1){
                appended_div += '<option value="'+index+'"> '+allow['title']+' </option>';
            }
        });


        appended_div += '</select> </div>';

        //value input
        appended_div += '<div class="col-lg-4 col-md-4  mb-4 allowance_div" >';
        appended_div += '<label class="label mb-2 ">القيمة</label>';
        appended_div += '<input name="allowance_val[]" class="form-control allowance_val_'+new_index+'" />';
        appended_div += '</div>';

        appended_div += '<div class="col-lg-4 col-md-4  mb-4 allowance_div">';
        appended_div += '<a class="btn btn-info update_allowance" data-update_index='+new_index+'>تحديث</a>';
        appended_div += '<a class="btn btn-danger remove_allowance" data-remove_index='+new_index+'><i class="fa fa-trash" aria-hidden="true"></i></a> </div></div>';

        $('.allowance_row').last().after(appended_div);

    });

    $('body').on('click', '.remove_allowance', function(e) {
        e.preventDefault();

        index_val = $(this).data('remove_index');
        $('.allowance_row_'+index_val).remove();
    });




</script>
@endsection
