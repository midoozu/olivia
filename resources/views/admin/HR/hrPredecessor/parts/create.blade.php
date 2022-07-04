<form action="{{route('hrPredecessor.store')}}" method="post" id="Form">
@csrf
    <div class="row">

        <div class="row mt-2 mb-2 p-3 text-center">
            <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
                 إضافة سلفة جديدة لموظف
            </button>
        </div>


        <div class="col-6 mb-4">
            <label class="label mb-2 "> الموظف   </label>
            <select name="employee_id" class="form-control" data-validation="required" >
                <option value="">إختر الموظف</option>
                @foreach($employees as $employee)
                 <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6 mb-4">
            <label class="label mb-2 "> المبلغ   </label>
           <input name="value" type="text" id="mainValue" placeholder=" المبلغ..."  class="form-control numbersOnly" data-validation="required" >
        </div>
        <div class="col-6 mb-4">
            <label class="label mb-2 "> تاريخ السلفة   </label>
           <input name="date" type="date" class="form-control" value="{{date('Y-m-d')}}"
                  data-validation="required" >
        </div>

        <div class="col-6 mb-4">
            <label class="label mb-2 "> النوع   </label>
            <select name="type" class="form-control" id="type" data-validation="required" >
                <option value="">إختر النوع</option>
                <option value="regular">منتظمة</option>
                <option value="unregular">غير منتظمة</option>
            </select>
        </div>

        <input name="created_by" type="hidden" value="{{auth()->user()->id}}">
        <input name="pay_status" type="hidden" value="new">




        <div class="col-12 mb-4" id="Batches" style="display: none">

            <h4>*الدفعات*</h4>

            <div class="table-responsive-md col-sm-12">
                <table class="table table-striped-table-bordered table-hover table-checkable table-" id="tbl_posts">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th >المبلغ</th>
                        <th >تاريخ الإستحقاق</th>
                        <th>
                            <a class="btn btn-info add-record click" data-added="0"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tbl_posts_body">
                    <tr id="rec-1" class="MainDivs">
                        <td><span class="sn">1</span>.</td>
                        <td>
                            <input type="text" name="value_[]" data-validation="required" class="form-control  numbersOnly smallValue" data-validation="required"  placeholder=" المبلغ..." >
                        </td>
                        <td>
                            <input type="date" name="date_[]"  class="form-control"  data-validation="required" >
                        </td>
                        <td><a class="btn btn-xs delete-record " data-id="1"><i style="color: #f4516c" class="fa fa-trash"></i></a></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>



    </div>


</form>
<div style="display:none;">
    <table id="sample_table">
        <tr id="" class="MainDivs">
            <td><span class="sn"></span>.</td>
            <td>
                <input type="text" name="value_[]" data-validation="required" class="form-control  numbersOnly smallValue" data-validation="required"  placeholder=" المبلغ..." >
            </td>
            <td>
                <input type="date" name="date_[]"  class="form-control"  data-validation="required" >
            </td>

            <td><a class="btn btn-xs delete-record " data-id="1"><i style="color: #f4516c" class="fa fa-trash"></i></a></td>
        </tr>
    </table>
</div>


@section('js')
@endsection
