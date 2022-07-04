<form action="{{route('admin.hrShifts.store')}}" method="post" id="Form">
@csrf
    <div class="row">

        <div class="row mt-2 mb-2 p-3 text-center">
            <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
                 إضافة شفيت موظفين جديد
            </button>
        </div>


        <div class="col-12 mb-4">
            <label class="label mb-2 "> العنوان   </label>
            <input type="text" name="title" value="" class="form-control" data-validation="required">
        </div>

        <input name="created_by" type="hidden" value="{{auth()->user()->id}}">

    </div>


</form>
