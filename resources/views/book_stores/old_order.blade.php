@extends('layouts.admin')
@section('content')


<div class="container">
    <h2 align="center">ประวัติการเบิกสื่อเทคโนโลยี</h2>
  <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">รายการเบิกวันที่</th>
            <th scope="col">ผู้เบิก</th>
            <th scope="col">จำนวนรายการเบิก</th>
            <th scope="col">สถานะการเบิก</th>
            <th scope="col">ยกเลิก</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=$books->perPage()*($books->currentPage()-1);?>
            @foreach ($books as $book)
            <tr><th scope="row"><?php $i++;?>{{$i}}</th>
                <th scope="row"> <a href="{{ route('report.ref',$book->id)}}" target="_blank"> {{date('d/m/Y', strtotime($book->created_at))}}</a></th>
                <th scope="row">{{$book->in_person}}</th>
                <td>{{$book->volume_book}}</td>
                <td><a class="btn btn-warning">รอการอนุมัติ</a></td>
                <td>   <a onClick="del({{$book->id}},{{Auth::user()->id}})" class="btn btn-danger" > <i class="far fa-trash-alt"></i> ยกเลิกการเบิก</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      ทั้งหมด : {{$books->total()}} / หน้าที่ {{$books->currentPage()}}
      {{$books->links('pagination::bootstrap-4')}}
      
</div>

@if(session()->has('status'))
<script>
    swal("<?php echo session()->get('status');?>","","success");
</script>
@endif

@endsection



