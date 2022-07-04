@extends('layouts.admin.admin')

@section('content')


        <div class="analytics-sparkle-area">
            <div class="container-fluid">
			<br>
			خزائن وحسابات بنكية: <a href="{{url('admin/addtreasurybank')}}" class="btn btn-success">إنشاء  خزائن وحسابات بنكية </a>
			<br><br>

<br>

<div class="panel panel-default">
  <div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>رقم الحساب</th>
        <th>التاريخ</th>
        <th>الاسم(en)</th>
        <th>الاسم(ar)</th>
        <th>النوع</th>
		<th>الوصف</th>
		<th>الاجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($safe_banks as $index=>$value)
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$value->tree->id_code}}</td>
        <td>{{$value->created_at}}</td>
		    <td>{{$value->name_en}}</td>
        <td>{{$value->name_ar}}</td>
        @if($value->type == 0)
          <td>خزنة</td>
        @else
          <td>بنك</td>
        @endif
        <td>{{$value->description}}</td>
		    <td>-</td>
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

