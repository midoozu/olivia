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

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <button id="addButton" class="btn mb-2 btn-success "> أضف <span class="icon-add_circle"></span>  </button>

            </div>
        </div>
    <div class="card">
        <div class="card-header">
            {{ trans('hr.hrShiftsTimes') }}
        </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table  id="test" class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShippingAndClearance" >

                                <thead>
                                <tr>
                                    <th width="10px" class="not-exported">

                                    </th>
                                    <th>م</th>
                                    <th>الشيفت</th>
                                    <th>القسم</th>
                                    <th>من </th>
                                    <th>إلى </th>
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
                this.api().columns([1,2,3,4,5]).every(function () {
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
            "ajax": "{{route('admin.hrShiftsTimes.index')}}",
            "columns": [
                { "data": 'placeholder', name: 'placeholder' },
                {"data": "id",   orderable: true,searchable: true},
                {"data": "shift",   orderable: true,searchable: true},
                {"data": "department",   orderable: true,searchable: true},
                {"data": "from_hour",   orderable: true,searchable: true},
                {"data": "to_hour",   orderable: true,searchable: true},
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





        //for input number validation
        $(document).on('keyup','.numbersOnly',function () {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on('click','#addButton',function (e) {
            e.preventDefault()
            $('.loader-ajax').show()
            var url = '{{route('admin.hrShiftsTimes.create')}}';
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){

                    $('.loader-ajax').show()
                },
                success: function(data){
                    window.setTimeout(function() {
                        $('#save').show()

                        $('.loader-ajax').hide()

                        $('#form-for-addOrDelete').html(data.html);
                        $('#exampleModalCenter').modal('show')
                        $('.dropify').dropify();

                        $('select').select2();
                        $.validate({
                        });
                    }, 2000);
                },
                error: function(jqXHR,error, errorThrown) {
                    $('.loader-ajax').Form.hide()
                    if(jqXHR.status&&jqXHR.status==500){
                        $('#exampleModalCenter').modal("hide");
                        $('#form-for-addOrDelete').html('<h3 class="text-center">لا تملك الصلاحية</h3>')
                        //save
                        messages.show("لا تملك هذه الصلاحية..", {
                            type: 'danger',
                            title: '',
                            icon: '<i class="icon-error"></i>',
                            delay:2000,
                        });
                    }


                }
            });
        });

        $(document).on('submit','form#Form',function(e) {
            e.preventDefault();

            var myForm = $("#Form")[0]
            var formData = new FormData(myForm)
            var url = $('#Form').attr('action');
            $.ajax({
                url:url,
                type: 'POST',
                data: formData,
                beforeSend: function(){
                    $('.loader-ajax').show()

                },
                complete: function(){


                },
                success: function (data) {

                    window.setTimeout(function() {

                        $('.loader-ajax').hide()

                        $('#exampleModalCenter').modal('hide')

                        $('#test').DataTable().ajax.reload();


                    }, 2000);


                },
                error: function (data) {
                    $('.loader-ajax').hide()
                    if (data.status === 500) {
                        // $('#exampleModalCenter').modal("hide");
                        messages.show("هناك خطأ", {
                            type: 'danger',
                            title: 'خطأ',
                            icon: '<i class="icon-alert-octagon"></i>',
                            delay:2000,
                        });
                    }
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    myToast(key, value, 'top-left', '#ff6849', 'error',4000, 2);

                                });

                            } else {

                            }
                        });
                    }
                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
        $(document).on('click','.editButton',function (e) {
            e.preventDefault()
            var id = $(this).attr('id');

            var url = '{{route('admin.hrShiftsTimes.edit',":id")}}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){

                    $('.loader-ajax').show()
                },
                success: function(data){
                    window.setTimeout(function() {
                        $('#save').show()

                        $('#form-for-addOrDelete').html(data.html);
                        $('.loader-ajax').hide()
                        $('#exampleModalCenter').modal('show')
                        $('.dropify').dropify();
                        $('.linear-background').hide()

                        $('select').select2();

                        $.validate({
                        });
                    }, 2000);
                },
                error: function(data) {
                    $('.loader-ajax').hide()
                    $('#form-for-addOrDelete').html('<h3 class="text-center">لا تملك الصلاحية</h3>')
                    messages.show("لا تملك هذه الصلاحية..", {
                        type: 'danger',
                        title: '',
                        icon: '<i class="icon-error"></i>',
                        delay:2000,
                    });
                }
            });

        });


        $(document).on('click', '.delete', function () {
            var id = $(this).attr('id');
            swal({
                title: "هل أنت متأكد من الحذف؟",
                text: "لا يمكنك التراجع بعد ذلك؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "الغاء",
                okButtonText: "موافق",
                closeOnConfirm: false
            }, function () {
                var url = '{{ route("admin.hrShiftsTimes.destroy", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id,_token:"{{csrf_token()}}"},
                    success: function (data) {
                        swal.close()
                        $('#test').DataTable().ajax.reload();
                        myToast('بنجاح', 'تم الأمر بنجاح', 'top-left', '#ff6849', 'success',4000, 2);
                        messages.show("تمت العملية بنجاح..", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });
                    },error: function(data) {
                        swal.close()
                        messages.show("لا تملك الصلاحية للحذف", {
                            type: 'danger',
                            title: '',
                            icon: '<i class="icon-error"></i>',
                            delay:2000,
                        });
                    }

                });
            });
        });


    </script>


@endsection
