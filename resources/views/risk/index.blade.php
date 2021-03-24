@extends('layouts.admin')
@section('content')


<div class="container">
    <h2 align="center">ข้อมูลความเสี่ยง</h2>
    <a href="{{ route('risk.create') }}" class="btn btn-primary my-2">รายงานความเสี่ยง</a>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">วันที่รายงาน</th>
            <th scope="col">วันที่เกิดเหตุ</th>
            <th scope="col">หัวข้อความเสี่ยง</th>
            <th scope="col">รายละเอียด</th>
            <th scope="col">สถานะ</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=$risks->perPage()*($risks->currentPage()-1);?>
            @foreach ($risks as $risk)
            <tr><th scope="row"><?php $i++;?>{{$i}}</th>
                <th scope="row">{{$risk->created_at->format('d/m/Y')}}</th>
                <td>{{date('d/m/Y', strtotime($risk->accident_date))}}</td>
                <td>{{$risk->risk_type}}</td>
                <td><a href="#" class="btn btn-info"><i class="fa fa-bars"></i> ดูรายละเอียด</a></td>
                <td><a href="#" class="btn btn-warning"><i class="fa fa-star"></i> สถานะ..</a></td>
            <td> <a href="{{route('risk.edit',$risk->id)}}" class="btn btn-success"><i class="far fa-edit"></i> แก้ไข</a></td>
                <td> 
                    <form action="{{route('risk.destroy',$risk->id)}}" method="post">
                      @csrf @method('DELETE')
                    <button type="submit" data-name="{{$risk->id}}" class="btn btn-danger deleteForm">
                    <i class="far fa-trash-alt"></i>
                        ลบข้อมูล
                    </button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      ทั้งหมด : {{$risks->total()}} / หน้าที่ {{$risks->currentPage()}}
      {{$risks->links('pagination::bootstrap-4')}}
      
</div>

@if(session()->has('status'))
<script>
    swal("<?php echo session()->get('status');?>","","success");
</script>
@endif


@endsection



