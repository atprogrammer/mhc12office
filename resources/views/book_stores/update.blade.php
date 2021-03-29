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


        
        <h1 style="text-align:center">แก้ไขรายการสื่อเทคโนโลยี</h1>
        
        <p style="text-align:right">
            <?php  
            $today = \Carbon\Carbon::now();
      
           echo $today->locale('th')->isoFormat('วัน dddd ,ที่ Do MMMM YYYY');
       
         
           echo '<br>';

          
           ?>              
          </p>  
  
    </header>
               
{!! Form::open(['route' => 'bookstores.update_stores','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf
{!! Form::hidden('user_id',Auth::user()->id) !!}


@foreach ($books as $book)
{!! Form::hidden('book_id',$book->id) !!}
<div class="form-row">
  <div class="form-group col-md-8">
       {!! Form::label('l_name_book', 'ชื่อสื่อเทคโนโลยี', ['class' => 'col-sm-6 col-form-label']) !!}
       <input type="text" class="form-control" id="name_book" name="name_book" value="{{$book->name_book}}" >
  </div>
  <div class="form-group col-md-4">
    {!! Form::label('l_book_type', 'ประเภท', ['class' => 'col-sm-6 col-form-label']) !!} 
    @if ($errors->has('book_type'))
    <span class="text-danger">* {{ $errors->first('book_type') }}</span>
    @endif
    <select class="form-control" id="book_type" name="book_type">
      <option value="">กรุณาเลือกข้อมูลประเภท</option>
      <option value="คู่มือ">คู่มือ</option>
      <option value="แผ่นพับ">แผ่นพับ</option>
      <option value="แบบประเมิน">แบบประเมิน</option>
      <option value="โปสเตอร์">โปสเตอร์</option>
      <option value="CD">CD</option>
    </select>
</div>
</div>


<div class="form-row">
  <div class="form-group col-md-4">
    {!! Form::label('l_book_from', 'รับจากหน่วยงาน', ['class' => 'col-sm-6 col-form-label']) !!}
    <input type="text" class="form-control" id="book_from" name="book_from" value="{{$book->book_from}}"> 
</div>
    <div class="form-group col-md-4">
      {!! Form::label('l_book_storage', 'สถานที่จัดเก็บ', ['class' => 'col-sm-6 col-form-label']) !!}
      <input type="text" class="form-control" id="book_storage" name="book_storage" value="{{$book->book_storage}}">  
 </div>
 <div class="form-group col-md-4">
    {!! Form::label('l_book_unit', 'หน่วยนับ', ['class' => 'col-sm-4 col-form-label']) !!} 
    @if ($errors->has('book_unit'))
    <span class="text-danger">* {{ $errors->first('book_unit') }}</span>
    @endif
    {!! Form::select('book_unit', ['เล่ม' => 'เล่ม', 'แผ่น' => 'แผ่น'], null,['class' => 'form-control','placeholder' => 'กรุณาเลือก...','id' => 'book_unit']) !!} 
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
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$book->book_detail}}</textarea>
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
            <input type="file" class="custom-file-input" id="inputGroupFile03" name="file_doc" value="{{$book->book_image}}"/>
            <label class="custom-file-label" for="inputGroupFile02">ไฟล์ภาพประกอบ(ถ้ามี)</label>
        </div>
    </div>
    <div class="input-group mb-3 col-md-4">
        {{asset($book->book_image)}}
            @if($book->book_image!=null)<img src="{{asset($book->book_image)}}"
            @else <img src="{{asset('images/book/title/title.png')}}"
            @endif width="100px" height="100px">
    </div>
    <br>
    @endforeach
    <h2>ตารางแก้ไขยอดที่รับเข้า</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>วันที่รับเข้า</th>
          <th>รายการ</th>
          <th>จำนวน</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=0;
              $count_book=0;
        ?>
        @foreach ($book_add as $add)
        <?php $i=0;
        $count_book=$count_book+$add->book_volume; //รวมจำนวนสื่อ
        ?>
        <tr>
          <td><?php $i++;?>{{$i}}</td>
          <td>{{$add->book_date}}</td>
          <td>{{$book->name_book}}</td>
          <td>{{$add->book_volume}}</td>
          <td><a href="{{route('bookstores.edit',$book->id)}}" class="btn btn-success"><i class="far fa-edit"></i> แก้ไข</a></td>
          <td> <a onClick="del({{$book->id}},{{Auth::user()->id}})" class="btn btn-danger" > <i class="far fa-trash-alt"></i> ลบข้อมูล</a></td>
        </tr>    
        @endforeach  
        <tr>
          <td></td>
          <td></td>
          <td><h4>จำนวนรวม : {{$count_book}}<h4></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>    
      </tbody>
    </table>

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