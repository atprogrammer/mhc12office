@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<div class="container">

    @if ($errors->all())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>
            {{$error}}
        </li>    
        @endforeach
    </ul>
    @endif
   
    <header>


        
        <h1 style="text-align:center">รายการเบิก</h1>
        
        <p style="text-align:right">
            <?php  
            $today = \Carbon\Carbon::now();
            //$tomorrow = \Carbon\Carbon::now()->addDay();
            //$lastWeek = \Carbon\Carbon::now()->subWeek();
   
              // Carbon embed 822 languages:
           echo $today->locale('th')->isoFormat('วัน dddd ,ที่ Do MMMM YYYY');
           //echo $time->locale('th')->isoFormat('hh:mm');
           //echo $tomorrow->locale('th')->isoFormat('Do MMMM YYYY');
         
           echo '<br>';
           //echo $tomorrow->locale('ar')->isoFormat('dddd, MMMM Do YYYY, h:mm');
           //echo 'แสดง ID '.Auth::user()->id;
          
           ?>              
          </p>  
  
    </header>
               
{!! Form::open(['route' => 'bookstores.action_book_store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf
{!! Form::hidden('user_id',Auth::user()->id) !!}






<div class="form-row">
    <div class="form-group col-md-4">
        {!! Form::label('l_book_date', 'วันที่เบิก', ['class' => 'col-sm-6 col-form-label']) !!} 
        {!! Form::text('book_date', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
    </div>
    <div class="form-group col-md-4">
            {!! Form::label('l_book_value', 'ชื่อผู้ขอเบิก', ['class' => 'col-sm-6 col-form-label']) !!}
            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled>
    </div>
  </div>

 
    <a href="{{ route('bookstores.action') }}" class="btn btn-primary my-2">เพิ่มรายการเบิก</a>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">รูปภาพ</th>
            <th scope="col">ชื่อสื่อ</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ลบ</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0;?>
          @foreach ($books as $book)
          {!! Form::hidden('book_id',$book->id) !!}
          <tr>
            <th scope="row">{{++$i}}</th>
            <td>
                @if($book->book_image!=null)<img src="{{asset($book->book_image)}}"
                @else <img src="{{asset('images/book/title/title.png')}}"
                @endif width="80px" height="80px"></th>
            </td>
            <td>{{$book->name_book}}</td>
            <input type="hidden" id="custId" name="addmore[{{$i}}][volume_book]" value="{{$book->volume_book}}">
            <input type="hidden" id="custId" name="addmore[{{$i}}][book_id]" value="{{$book->volume_book}}">
            <td>{{$book->volume_book}}</td>
            <td>
              <a href="{{ route('bookstores.action_book_destroy',[$book->id,Auth::user()->id])}}" class="btn btn-danger" > <i class="far fa-trash-alt"></i> ลบข้อมูล</a>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <p></p>
      <button type="submit" class="btn btn-success">
        <i class="far fa-save"></i> บันทึก
      </button>
      <a href="{{ route('bookstores.action') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> กลับ</a>
      <p></p>
{!! Form::close() !!}
</div>

<script>
    $('#datepicker').datepicker({
            locale: 'th-TH',
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
    });

            $('#inputGroupFile02').on('change',function(){
                var fileName = $(this).val();
                $(this).next('.custom-file-label').html(fileName);
            })

            $('#inputGroupFile03').on('change',function(){
                var fileName = $(this).val();
                $(this).next('.custom-file-label').html(fileName);
            })

            //ใส่ค่าได้เฉพาะตัวเลข
            $("#book_volume").bind('keypress', function(e) { 
	            return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
            })
           
            $( "#input_type" ).change(function() {
              var data = $(this).val();
              //alert(data);
              if(data=="0"){
                window.location.href = '{{ route('search_old.create') }}';
                //window.location.href = '{{ route('search_old.create') }}'+'/'+data;
                
              }else{
                window.location.href = '{{ route('bookstores.create') }}';
              }
              
            });


            
       
</script>

@endsection