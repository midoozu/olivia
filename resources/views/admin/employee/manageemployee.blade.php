@extends('layouts.admin.admin')

@section('content')


        <div class="analytics-sparkle-area">
            <div class="container-fluid">
			    <br>
			ادارة الموظفين:     <a href="{{url('admin/addemployee')}}" class="btn btn-success">اضافة موظف</a>
			    <br><br>
			<div class="row">
			<div class="col-md-3">
			    <b>اجمالي عدد الموظفين</b> <span style="color:green;font-size:16px;">{{count($employees)}}</span>
			</div>
			<div class="col-md-3">
			    <b>اجمالي المرتبات</b> <span style="color:green;font-size:16px;">500</span>
			</div>
        </div>
        <br>
        <div class="panel panel-default">
      <div class="panel-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-InvoiceTranslate">                    <thead>
                      <tr>
                        <th class="not-exported">#</th>
                        <th>كودالموظف</th>
                        <th>إسم الموظف</th>
                        <th>تاريخ الإلتحاق</th>
                        <th>إدارة الموظف</th>
                        <th>قيمة الراتب</th>
                        <th>الهدف</th>
                        <th>العمولة</th>
                        <th>نوع الدوام</th>
                        <th>الحالة</th>
                        <th class="not-exported">الاجراءات</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $index=>$employee)
                            <tr>
                                <td></td>
                                <td>{{$employee->code}}</td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->hiring_date}}</td>
                                <td>{{$employee->department->department}}</td>
                                <td>20</td>
                                <td>100</td>
                                <td>100</td>
                                <td>{{$employee->period_type->period_type}}</td>
                                <td>{{$employee->activation->activation}}</td>
                                <td>
                                <a href="{{url('admin/employeedetail')}}/{{$employee->id}}" class="btn btn-info">
                            <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
        </div>
    </div>
            </div>
        </div>


    @endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-InvoiceTranslate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
