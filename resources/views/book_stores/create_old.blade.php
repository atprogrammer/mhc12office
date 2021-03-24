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


        
        <h1 style="text-align:center">บันทึกรายการสื่อเทคโนโลยี</h1>
        
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
               
{!! Form::open(['route' => 'bookstores.store_old','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf
{!! Form::hidden('user_id',Auth::user()->id) !!}


@foreach ($books as $book)
{!! Form::hidden('book_id',$book->id) !!}
<div class="form-row">
  <div class="form-group col-md-8">
       {!! Form::label('l_name_book', 'ชื่อสื่อเทคโนโลยี', ['class' => 'col-sm-6 col-form-label']) !!}
       <input type="text" class="form-control" id="lname" name="lname" value="{{$book->name_book}}" disabled>
  </div>
  <div class="form-group col-md-4">
    {!! Form::label('l_book_type', 'ประเภท', ['class' => 'col-sm-6 col-form-label']) !!} 
    <input type="text" class="form-control" id="lname" name="lname" value="{{$book->book_type}}" disabled>
</div>
</div>


<div class="form-row">
  <div class="form-group col-md-4">
    {!! Form::label('l_book_from', 'รับจากหน่วยงาน', ['class' => 'col-sm-6 col-form-label']) !!}
    <input type="text" class="form-control" id="lname" name="lname" value="{{$book->book_from}}" disabled> 
</div>
    <div class="form-group col-md-4">
        {!! Form::label('l_book_date', 'วันที่รับสื่อ', ['class' => 'col-sm-6 col-form-label']) !!} 
        {!! Form::text('book_date', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
    </div>
    <div class="form-group col-md-4">
      {!! Form::label('l_book_storage', 'สถานที่จัดเก็บ', ['class' => 'col-sm-6 col-form-label']) !!}
      <input type="text" class="form-control" id="lname" name="lname" value="{{$book->book_storage}}" disabled>  
 </div>
  </div>
   


    
    
    <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-danger">
            <div class="card-header">
              <h3 class="card-title">
                รายละเอียดสื่อเทคโนโลยี
                <small></small>
              </h3>

      
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
                <textarea name="book_detail" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" disabled>{{$book->book_detail}}</textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
      @if ($errors->has('file_doc'))
      <div class="input-group mb-3 col-md-4">
      <span class="text-danger">* {{ $errors->first('file_doc') }}</span>
    </div>
      @endif
    <div class="input-group mb-3 col-md-4">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile03" name="file_doc"/>
            <label class="custom-file-label" for="inputGroupFile02">ไฟล์หนังสือนำส่ง(ถ้ามี)</label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
             {!! Form::label('l_book_volume', 'จำนวน', ['class' => 'col-sm-3 col-form-label']) !!}
             @if ($errors->has('book_volume'))
             <span class="text-danger">* {{ $errors->first('book_volume') }}</span>
             @endif
             {!! Form::text('book_volume',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกจำนวน','id' => 'book_volume']) !!} 
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('l_book_unit', 'หน่วยนับ', ['class' => 'col-sm-4 col-form-label']) !!} 
            <input type="text" class="form-control" id="lname" name="lname" value="{{$book->book_unit}}" disabled>
        </div>
    </div>
    @endforeach
      <p></p>
      <button type="submit" class="btn btn-success">
        <i class="far fa-save"></i> บันทึก
      </button>
      <a href="{{ route('search_old.create') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> กลับ</a>
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