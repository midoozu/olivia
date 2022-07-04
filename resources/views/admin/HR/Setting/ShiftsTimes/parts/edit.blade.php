
            <form action="{{route('admin.hrShiftsTimes.update',$find->id)}}" method="post" id="Form">
            @csrf
            @method('PUT')

                <div class="row mt-2 mb-2 p-3 text-center">
                    <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
                        تعديل شيفت القسم
                    </button>
                </div>
                <div class="row">


                <div class="col-6 mb-4">
                    <label class="label mb-2 ">الشيفت</label>
                    <select class="form-control" data-validation="required" name="shift_id">
                        <option value="">إحتر الشيفت</option>
                        @foreach($Shifts as $Shift)
                            <option value="{{$Shift->id}}"  {{$find->shift_id == $Shift->id?'selected':''}}>{{$Shift->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-4">
                    <label class="label mb-2 ">القسم</label>
                    <select class="form-control" data-validation="required" name="department_id">
                        <option value="">إحتر القسم</option>
                        @foreach($Departments as $Department)
                            <option value="{{$Department->id}}" {{$find->department_id == $Department->id?'selected':''}}>{{$Department->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label class="label mb-2 ">من </label>
                    <input type="time" class="form-control" value="{{date('H:i',strtotime($find->from_hour))}}" name="from_hour" data-validation="required">
                </div>
                <div class="col-6 mb-4">
                    <label class="label mb-2 ">إلى </label>
                    <input type="time" class="form-control" value="{{date('H:i',strtotime($find->to_hour))}}" name="to_hour" data-validation="required">
                </div>

                </div>

                <input name="updated_by" type="hidden" value="{{auth()->user()->id}}">
            </form>



