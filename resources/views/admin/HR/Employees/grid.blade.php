@extends('layouts.admin.admin')

@section('styles')
    <link href="{{asset('admin')}}/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="{{asset('admin/css/select2.css')}}" rel="stylesheet">
    @include('layouts.admin.loader.loaderCss')
@endsection

@section('content')
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{asset('admin/backEndFiles/sweetalert/sweetalert.css')}}">--}}
    <link href="{{asset('admin')}}/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="{{asset('admin/css/select2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/backEndFiles/sweetalert/sweetalert.css')}}">

    <div id="messages"></div>
    <div id="notes"></div>
    <section class="brands-page my-5">

        <div class="col-12 mb-2">
            <a href="{{route('admin.HREmployee.create')}}" class="btn mb-2 btn-success "> أضف <span class="icon-add_circle"></span>  </a>
        </div>

        <!-- basic table -->
        <div class="row">
            <div class="col-12 mb-2">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      {{Session::get('success')}}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body">


                        <div class="table-responsive">
                            <table  id="test" class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShippingAndClearance" >

                                <thead>
                                <tr>
                                    <th width="10px" class="not-exported">

                                    </th>
                                    <th>م</th>
                                    <th>الإسم</th>
                                    <th>رقم التليفون</th>
                                    <th>البريد الإلكترونى</th>
                                    <th>القسم</th>
                                    <th>الراتب</th>
                                    <th class="not-exported">التحكم</th>


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
            </div>
        </div>
        <!-- order table -->





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
                {"data": "name",   orderable: true,searchable: true},
                {"data": "phone",   orderable: true,searchable: true},
                {"data": "email",   orderable: true,searchable: true},
                {"data": "department_id",   orderable: true,searchable: true},
                {"data": "salary",   orderable: true,searchable: true},
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
