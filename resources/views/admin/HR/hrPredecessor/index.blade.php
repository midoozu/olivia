@extends('admin.layouts.layout')

@section('styles')
    <link href="{{asset('admin')}}/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="{{asset('admin/css/select2.css')}}" rel="stylesheet">
    @include('admin.layouts.loader.loaderCss')
@endsection

@section('page-title')
    سلف الموظفين
@endsection

@section('current-page-name')
    سلف الموظفين
@endsection

@section('page-links')
    <li class="breadcrumb-item active">
        <a href="">منتظر التعديل</a>
    </li>
    <li class="breadcrumb-item active"> سلف الموظفين</li>
@endsection

@section('content')

    <div id="messages"></div>
    <div id="notes"></div>
    <section class="brands-page my-5">

        <!-- basic table -->
        <div class="row">
            <div class="col-12 mb-2">
                <button id="addButton" class="btn mb-2 btn-success "> أضف <span class="icon-add_circle"></span>  </button>
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="basicExample" class="table  table-bordered">

                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>الموظف </th>
                                    <th>القيمة</th>
                                    <th>النوع</th>
                                    <th>الحالة</th>
                                    <th>تاريخ السلفة</th>
                                    <th>التحكم</th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
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

                        <button type="button" class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start" data-bs-dismiss="modal">الغاء</button>

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

                        <button type="button" class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start" data-bs-dismiss="modal">الغاء</button>

                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection

@section('js')
    <script src="{{asset('admin')}}/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin/js/select2.js')}}"></script>
    <script src="{{asset('admin/backEndFiles/repeater/jquery.repeater.min.js')}}"></script>

    <script>

        var messages = $('#messages').notify({
            type: 'messages',
            removeIcon: '<i class="icon-close"></i>'
        });

        $("#basicExample").DataTable({

            dom: 'Bfrtip',
            responsive: 1,
            "processing": true,
            "lengthChange": true,
            "serverSide": true,
            "ordering": true,
            "searching": true,
            'iDisplayLength': 20,
            "ajax": "{{route('hrPredecessor.index')}}",
            "columns": [
                {"data": "id",   orderable: true,searchable: true},
                {"data": "employee",   orderable: true,searchable: true},
                {"data": "value",   orderable: true,searchable: true},
                {"data": "type",   orderable: true,searchable: true},
                {"data": "pay_status",   orderable: true,searchable: true},
                {"data": "date",   orderable: true,searchable: true},
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


        //========================================================================
        //========================================================================
        //=======================Add , edit model=================================
        //========================================================================
        $(document).on('click','#addButton',function (e) {
            e.preventDefault()
            var url = '{{route('hrPredecessor.create')}}';
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){
                    $('select').each(function () {
                        $(this).select2({ dropdownParent: $(this).parent() });
                    });

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

        $(document).on('click','.editButton',function (e) {
            e.preventDefault()
            var id = $(this).attr('id');

            var url = '{{route('hrPredecessor.edit',":id")}}';
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





        $(document).on('click','.showButton',function (e) {
            e.preventDefault()
            var id = $(this).attr('id');

            var url = '{{route('hrPredecessor.show',":id")}}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){
                    $('select').each(function () {
                        $(this).select2({ dropdownParent: $(this).parent() });
                    });


                    $('.loader-ajax').show()
                },
                success: function(data){
                    window.setTimeout(function() {
                        $('#save').hide()
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

        //=========================================================
        //=========================================================
        //========================Save Data=========================
        //=========================================================

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
                        messages.show("تمت العملية بنجاح..", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });
                        $('#basicExample').DataTable().ajax.reload();

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
        //========================================================================
        //========================================================================
        //============================Delete======================================
        //========================================================================
        //delete one row
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
                var url = '{{ route("hrPredecessor.destroy", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id},
                    success: function (data) {
                        swal.close()
                        myToast('بنجاح', 'تم الأمر بنجاح', 'top-left', '#ff6849', 'success',4000, 2);
                        messages.show("تمت العملية بنجاح..", {
                            type: 'success',
                            title: '',
                            icon: '<i class="jq-icon-success"></i>',
                            delay:2000,
                        });
                        $('#basicExample').DataTable().ajax.reload();
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



        //delete multi rows
        $(document).on('click', '#checkAll', function () {
            var check=true;
            $('.delete-all:checked').each(function () {
                check=false;
            });

            $('.delete-all').prop('checked', check);
        });

    </script>

    <script>
        jQuery(document).delegate('a.add-record', 'click', function(e) {
            e.preventDefault();
            var content = jQuery('#sample_table tr'),
                size = jQuery('#tbl_posts >tbody >tr').length + 1,
                element = null,
                element = content.clone();
            element.attr('id', 'rec-'+size);
            element.find('.delete-record').attr('data-id', size);
            element.appendTo('#tbl_posts_body');
            element.find('.sn').html(size);

        });
        jQuery(document).delegate('a.delete-record', 'click', function(e) {

            e.preventDefault();



            var numdivs = $('.MainDivs').length;

            if (numdivs == 2){
                alert('لا يمكن الحذف')
            }else {




                var id = jQuery(this).attr('data-id');
                var targetDiv = jQuery(this).attr('targetDiv');
                jQuery('#rec-' + id).remove();

                //regnerate index number on table
                $('#tbl_posts_body tr').each(function (index) {
                    //alert(index);
                    $(this).find('span.sn').html(index + 1);
                });

                var sum = 0;
                $('.smallValue').each(function(){
                    sum += parseInt($(this).val()) || 0;  // Or this.innerHTML, this.innerText
                });


                console.log(sum,parseInt($('#mainValue').val()))

                if (parseInt($('#mainValue').val()) != sum){
                    $('#save').attr('type','button')
                }else {
                    $('#save').attr('type','submit')
                }
                return true;

            }


            // var didConfirm = confirm("Are you sure You want to delete");
            // if (didConfirm == true) {

            // } else {
            //   return false;
            // }
        });
        $(document).on('change click keyup','#type',function (e) {
            e.preventDefault()

            var type = $(this).val();


            if (type == 'regular'){

                $('#Batches').show()

            }else {
                $('#Batches').hide()
            }


        });

        $(document).on('change click keyup','.smallValue',function (e) {
            e.preventDefault()

                var sum = 0;
                $('.smallValue').each(function(){
                    sum += parseInt($(this).val()) || 0;  // Or this.innerHTML, this.innerText
                });

                console.log(sum,parseInt($('#mainValue').val()))

                if (parseInt($('#mainValue').val()) != sum){
                    $('#save').attr('type','button')
                }else {
                    $('#save').attr('type','submit')
                }
        });
        $(document).on('change click keyup','#mainValue',function (e) {
            e.preventDefault()

            if ($('#type').val() == 'regular'){
                var sum = 0;
                $('.smallValue').each(function(){
                    sum += parseInt($(this).val()) || 0;  // Or this.innerHTML, this.innerText
                });

                console.log(sum,parseInt($('#mainValue').val()))

                if (parseInt($('#mainValue').val()) != sum){
                    $('#save').attr('type','button')
                }else {
                    $('#save').attr('type','submit')
                }
            }

        });

        $(document).on('change click keyup','#save',function (e) {
            e.preventDefault()

            if ($(this).attr('type') == 'button'){
                alert('مجموع الدفعات غير مساوى للمبلغ')
            }else {
                $('form#Form').submit()
            }

        });


    </script>

@endsection
