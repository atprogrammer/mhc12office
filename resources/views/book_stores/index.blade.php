@extends('layouts.admin')
@section('content')


<div class="container">
    <h2 align="center">รายการสื่อเทคโนโลยี</h2>
    <a href="{{ route('bookstores.create') }}" class="btn btn-primary my-2">เพิ่มรายการสื่อเทคโนโลยี</a>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">รูปภาพ</th>
            <th scope="col">วันที่ลงทะเบียนสื่อ</th>
            <th scope="col">รายชื่อสื่อ</th>
            <th scope="col">รายละเอียด</th>
            <th scope="col">จำนวนคงเหลือ</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=$books->perPage()*($books->currentPage()-1);?>
            @foreach ($books as $book)
            <tr><th scope="row"><?php $i++;?>{{$i}}</th>
                <th scope="row">
                    @if($book->book_image!=null)<img src="{{asset($book->book_image)}}"
                    @else <img src="{{asset('images/book/title/title.png')}}"
                    @endif width="100px" height="100px"></th>
                <th scope="row">{{date('d/m/Y', strtotime($book->created_at))}}</th>
                <td>{{$book->name_book}}</td>
                <td>
                    @if($book->book_detail!=null)
                    <button type="button" class="btn btn-primary" onclick="swal({ title: 'รายละเอียดสื่อ', text: '{{$book->book_detail}}' });">รายละเอียด</button>
                    @else
                    <button type="button" class="btn btn-secondary">ไม่มีรายละเอียด</button>
                    @endif
                <td><a href="#" class="btn btn-warning">@if($book->total!=null){{$book->total}}@else{{$book->book_volume}}@endif </a></td>
            <td> <a href="{{route('bookstores.edit',$book->id)}}" class="btn btn-success"><i class="far fa-edit"></i> แก้ไข</a></td>
                <td> 
                    <form action="{{route('risk.destroy',$book->id)}}" method="post">
                      @csrf @method('DELETE')
                    <button type="submit" data-name="{{$book->id}}" class="btn btn-danger deleteForm">
                    <i class="far fa-trash-alt"></i>
                        ลบข้อมูล
                    </button>
                </form>
                </td>
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



