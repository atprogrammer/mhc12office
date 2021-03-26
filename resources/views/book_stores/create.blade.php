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
               
{!! Form::open(['route' => 'bookstores.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf
{!! Form::hidden('user_id',Auth::user()->id) !!}

<div class="form-row">
  <div class="form-group col-md-5">
  {!! Form::label('inputPassword4', 'การนำเข้า', ['class' => 'col-sm-4 col-form-label']) !!} 
  <select class="form-control" id="input_type" name="input_type">
    <option value="1" {{$ch == 'new' ? ' selected="selected"' : ''}}>สื่อใหม่</option>
    <option value="0" {{$ch == 'old' ? ' selected="selected"' : ''}}>สื่อเดิม</option>
  </select>
</div>
</div>
@if($ch == 'new')
<div class="form-row">
  <div class="form-group col-md-8">
       {!! Form::label('l_name_book', 'ชื่อสื่อเทคโนโลยี', ['class' => 'col-sm-6 col-form-label']) !!}
       @if ($errors->has('name_book'))
       <span class="text-danger">* {{ $errors->first('name_book') }}</span>
       @endif
       {!! Form::text('name_book',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกชื่อสื่อเทคโนโลยี']) !!} 
  </div>
  <div class="form-group col-md-4">
    {!! Form::label('l_book_type', 'ประเภท', ['class' => 'col-sm-6 col-form-label']) !!} 
    @if ($errors->has('book_type'))
    <span class="text-danger">* {{ $errors->first('book_type') }}</span>
    @endif
    {!! Form::select('book_type', ['คู่มือ' => 'คู่มือ', 'แผ่นพับ' => 'แผ่นพับ', 'แบบประเมิน' => 'แบบประเมิน'], null,['class' => 'form-control','placeholder' => 'กรุณาเลือก...','id' => 'target']) !!} 
</div>
</div>
@endif
@if($ch == 'old')

<br>
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

<div class="form-row">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ลำดับ</th>
        <th scope="col">รูปภาพ</th>
        <th scope="col">วันที่ลงทะเบียนสื่อ</th>
        <th scope="col">รายชื่อสื่อ</th>
        <th scope="col">รายละเอียด</th>
        <th scope="col">จำนวนคงเหลือ</th>
        <th scope="col">เพิ่ม</th>
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
        <td> <a href="{{route('bookstores.add_old',$book->id)}}" class="btn btn-success"><i class="far fa-edit"></i> รับเข้า</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
  ทั้งหมด : {{$books->total()}} / หน้าที่ {{$books->currentPage()}}
  {{$books->links('pagination::bootstrap-4')}}
</div>
 @else


<div class="form-row">
  <div class="form-group col-md-4">
    {!! Form::label('l_book_from', 'รับจากหน่วยงาน', ['class' => 'col-sm-6 col-form-label']) !!}
    @if ($errors->has('book_from'))
    <span class="text-danger">* {{ $errors->first('book_from') }}</span>
    @endif
    {!! Form::text('book_from',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกหน่วยงานที่ส่งมอบ']) !!} 
</div>
    <div class="form-group col-md-4">
        {!! Form::label('l_book_date', 'วันที่รับสื่อ', ['class' => 'col-sm-6 col-form-label']) !!} 
        {!! Form::text('book_date', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
    </div>
    <div class="form-group col-md-4">
      {!! Form::label('l_book_storage', 'สถานที่จัดเก็บ', ['class' => 'col-sm-6 col-form-label']) !!}
      @if ($errors->has('book_storage'))
      <span class="text-danger">* {{ $errors->first('book_storage') }}</span>
      @endif
      {!! Form::text('book_storage',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกชื่อสื่อเทคโนโลยี']) !!} 
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

              @if ($errors->has('book_detail'))
              <span class="text-danger"><br>* {{ $errors->first('book_detail') }}</span>
              @endif
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
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('book_detail')}}</textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
      @if ($errors->has('file_image'))
      <div class="input-group mb-3 col-md-4">
      <span class="text-danger">* {{ $errors->first('file_image') }}</span>
    </div>
      @endif
      <div class="input-group mb-3 col-md-4">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile02" name="file_image"/>
            <label class="custom-file-label" for="inputGroupFile02">รูปภาพสื่อ(ถ้ามี)</label>
        </div>
    </div>
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
            @if ($errors->has('book_unit'))
            <span class="text-danger">* {{ $errors->first('book_unit') }}</span>
            @endif
            {!! Form::select('book_unit', ['เล่ม' => 'เล่ม', 'แผ่น' => 'แผ่น'], null,['class' => 'form-control','placeholder' => 'กรุณาเลือก...','id' => 'book_unit']) !!} 
        </div>
    </div>

      <p></p>
      <button type="submit" class="btn btn-success">
        <i class="far fa-save"></i> บันทึก
      </button>
      <a href="{{ route('bookstores.index') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> กลับ</a>
      <p></p>
{!! Form::close() !!}

@endif
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

            $("#search_name_btn").click(function() {
              var data = $( "#search_name" ).val();
              if(data==""){
                swal({ title: 'ข้อผิดพลาด', text: 'ยังไม่ได้พิมพ์ค้นหา' });
                window.location.href = '{{ route('bookstores.search') }}'+'/'+data;
              }else{
                 window.location.href = '{{ route('bookstores.search') }}'+'/'+data;
              }
              
            });
           


            
       
</script>

@endsection