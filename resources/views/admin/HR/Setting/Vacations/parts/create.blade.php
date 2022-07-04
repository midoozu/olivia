<form action="{{route('admin.hrVacations.store')}}" method="post" id="Form">
@csrf
    <div class="row">

        <div class="row mt-2 mb-2 p-3 text-center">
            <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
                 إضافة إعدادات أجازة جديد
            </button>
        </div>


        <div class="col-12 mb-4">
            <label class="label mb-2 "> العنوان   </label>
            <input type="text" name="title" value="" class="form-control" data-validation="required">
        </div>
        <div class="col-12 mb-4">
            <label class="label mb-2 ">النوع</label>
            <select class="form-control" data-validation="required" name="type">
                <option value="">إحتر النوع</option>
                <option value="official">رسمية</option>
                <option value="unofficial">غير رسمية</option>
            </select>
        </div>

        <input name="created_by" type="hidden" value="{{auth()->user()->id}}">

    </div>


</form>
