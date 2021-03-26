@extends('layouts.admin')
@section('content')


<div class="container">
    <h2 align="center">รายการสื่อเทคโนโลยี</h2>
    <div class="form-row">
        <div class="form-group col-md-6"> 
          {!! Form::label('l_book_from', 'ค้นหารายชื่อสื่อเทคโนโลยี', ['class' => 'col-sm-6 col-form-label']) !!}
        <div class="input-group mb-3"> 
          <input type="text"  class="form-control" id="search_name"  placeholder="พิมพ์เพื่อค้นหา">
          <div class="input-group-append">
            <a href="#" id="search_name_btn" class="btn btn-primary"><i class="fas fa-search"></i></a>
           </div>
        </div>
        </div>
        <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">รูปภาพ</th>
            <th scope="col">วันที่ลงทะเบียนสื่อ</th>
            <th scope="col">รายชื่อสื่อ</th>
            <th scope="col">รายละเอียด</th>
            <th scope="col">จำนวนคงเหลือ</th>
            <th scope="col">ใส่ตะกร้า</th>
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
            <td> <a  onclick="send_action('{{$book->name_book}}','{{$book->id}}','{{$book->book_unit}}','@if($book->total!=null){{$book->total}}@else{{$book->book_volume}}@endif','{{Auth::user()->id}}')" class="btn btn-success"><i class="fas fa-shopping-cart"></i> ใส่ตะกร้า</a></td>
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

<script>
$("#search_name_btn").click(function() {
    var data = $( "#search_name" ).val();
    if(data==""){
      //swal({ title: 'ข้อผิดพลาด', text: 'ยังไม่ได้พิมพ์ค้นหา' });
      window.location.href = '{{ route('bookstores.action') }}'+'/'+data;
    }else{
       window.location.href = '{{ route('bookstores.action') }}'+'/'+data;
    }
    
  });
  

function send_action(name,id,unit,volume,user_id){
Swal.fire({
  text: 'คุณต้องการเบิกสื่อเรื่อง "'+name+'" จำนวนกี่'+unit+' ?',
  input: 'number',
  showCancelButton: true,
  cancelButtonText: 'ยกเลิก'
}).then(function(result) {
  if (result.value) {
    var amount = result.value
    amount=parseInt(amount); //แปลงเป็น INT
    if(amount > volume){
    Swal.fire('คุณเบิกเกินจำนวนที่มีอยู่ คือ\n'+volume+' '+unit +'\n กรุณาระบุจำนวนใหม่อีกครั้ง')
    }else if(amount<=0){
      Swal.fire('ต้องมีค่ามากกว่า 0')     
    }else{
    //Swal.fire(amount + unit)
    window.location.href = '{{ route('bookstores.action_book') }}'+'/'+amount+'/'+id+'/'+user_id;
    }
  }
})
}

</script>

@endsection



