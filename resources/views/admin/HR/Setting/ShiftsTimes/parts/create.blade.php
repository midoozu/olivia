<form action="{{route('admin.hrShiftsTimes.store')}}" method="post" id="Form">
@csrf

    <div class="row mt-2 mb-2 p-3 text-center">
        <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
            إضافة شيفت قسم جديد
        </button>
    </div>
    <div class="row">


        <div class="col-6 mb-4">
            <label class="label mb-2 ">الشيفت</label>
            <select class="form-control" data-validation="required" name="shift_id">
                <option value="">إحتر الشيفت</option>
                @foreach($Shifts as $Shift)
                    <option value="{{$Shift->id}}">{{$Shift->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-4">
            <label class="label mb-2 ">القسم</label>
            <select class="form-control" data-validation="required" name="department_id">
                <option value="">إحتر القسم</option>
                @foreach($Departments as $Department)
                    <option value="{{$Department->id}}">{{$Department->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6 mb-4">
            <label class="label mb-2 ">من </label>
            <input type="time" class="form-control" name="from_hour" data-validation="required">
        </div>
        <div class="col-6 mb-4">
            <label class="label mb-2 ">إلى </label>
            <input type="time" class="form-control" name="to_hour" data-validation="required">
        </div>

        <input name="created_by" type="hidden" value="{{auth()->user()->id}}">

    </div>


</form>
