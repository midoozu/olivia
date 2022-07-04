@extends('layouts.admin.admin')
@section('content')
    <style>
        .select2-search__field{
            width: 100%!important;
        }
    </style>
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{asset('admin/backEndFiles/sweetalert/sweetalert.css')}}">--}}
    <link href="{{asset('admin')}}/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="{{asset('admin/css/select2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/backEndFiles/sweetalert/sweetalert.css')}}">

    @include('layouts.admin.loader.loaderCss')
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('success')}}
        </div>
    @endif
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a href="{{route('admin.HREmployeeBonus.create')}}" class="btn mb-2 btn-success "> أضف <span class="icon-add_circle"></span>  </a>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('hr.HREmployeeBonus') }}
        </div>
        <div class="card-body">


            <div class="table-responsive">
                            <table  id="test" class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShippingAndClearance" >

                                <thead>
                                <tr>
                                    <th width="10px" class="not-exported">

                                    </th>
                                    <th>م</th>
                                    <th>الموظف </th>
                                    <th>القيمة</th>
                                    <th>التفاصيل</th>
                                    <th>شهر</th>
                                    <th>سنة</th>
                                    <th  class="not-exported">التحكم</th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
            </div>
        </div>
    </div>
    <!-- order table -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
        <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">


            <div class="modal-content" style="overflow-y: scroll !important;">

                <div class="modal-body" id="form-for-addOrDelete">

                </div>
                <div class="modal-footer text-center d-flex justify-content-center">
                    <button id="save"  form="Form"  type="submit" class="btn btn-success">حفظ </button>

                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start" data-dismiss="modal">الغاء</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter2" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
        <div class="modal-dialog  modal-fullscreen modal-dialog-centered" role="document">


            <div class="modal-content" style="overflow-y: scroll !important;">

                <div class="modal-body" id="form-for-addOrDelete2">

                </div>
                <div class="modal-footer text-center d-flex justify-content-center">

                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start" data-dismiss="modal">الغاء</button>

                </div>
            </div>
        </div>
    </div>


    </section>
@endsection

@section('scripts')


    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="{{asset('admin/backEndFiles/sweetalert/sweetalert.min.js')}}"></script>

    <script>


        $("#test").DataTable({
            buttons: [
                {
                    extend:'copy',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible',
                        text:'الطباعة'
                    }
                },{
                    extend:'print',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible',
                        text:'الطباعة'
                    }
                },{
                    extend:'pdf',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible',
                        text:'pdf'
                    }
                },{
                    extend:'excel',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible',
                        text:'excel'
                    }
                },{
                    extend:'csv',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible',
                        text:'csv'
                    }
                }
            ],
            initComplete: function () {
                this.api().columns([1,2,3,4,5,6]).every(function () {
                    var column = this;
                    var search = $(`<input style="font-size: 85%;height: 15px;width: 100%" class="form-control form-control-sm" type="text" placeholder="بحث .... ">`)
                        .appendTo($(column.footer()).empty())
                        .on('change input', function () {
                            var val = $(this).val()

                            column
                                .search(val ? val : '', true, false)
                                .draw();
                        });
                });
            },
            dom: 'Bfrtip',
            responsive: 1,
            "processing": true,
            "lengthChange": true,
            "serverSide": true,
            "ordering": true,
            "searching": true,
            'iDisplayLength': 20,
            "ajax": "{{$route_url}}",
            "columns": [
                {"data": "placeholder",   orderable: true,searchable: true},
                {"data": "id",   orderable: true,searchable: true},
                {"data": "employee_id",   orderable: true,searchable: true},
                {"data": "value",   orderable: true,searchable: true},
                {"data": "details",   orderable: true,searchable: true},
                {"data": "month",   orderable: true,searchable: true},
                {"data": "year",   orderable: true,searchable: true},
                {"data": "actions", orderable: false, searchable: false}
            ],
            "language": {
                "sProcessing":   "{{trans('admin.sProcessing')}}",
                "sLengthMenu":   "{{trans('admin.sLengthMenu')}}",
                "sZeroRecords":  "{{trans('admin.sZeroRecords')}}",
                "sInfo":         "{{trans('admin.sInfo')}}",
                "sInfoEmpty":    "{{trans('admin.sInfoEmpty')}}",
                "sInfoFiltered": "{{trans('admin.sInfoFiltered')}}",
                "sInfoPostFix":  "",
                "sSearch":       "{{trans('admin.sSearch')}}:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "{{trans('admin.sFirst')}}",
                    "sPrevious": "{{trans('admin.sPrevious')}}",
                    "sNext":     "{{trans('admin.sNext')}}",
                    "sLast":     "{{trans('admin.sLast')}}"
                }
            },
            order: [
                [2, "desc"]
            ],
        })








    </script>


@endsection
