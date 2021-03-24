@extends('layouts.admin')

@section('content')


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


        
        <h1 style="text-align:center">แบบรายงานความเสี่ยง</h1>
        
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

{!! Form::open(['route' => 'risk.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}

{!! Form::hidden('user_id',Auth::user()->id) !!}
<div class="form-row">
    <div class="form-group col-md-5">
        {!! Form::label('lday', 'วันที่เกิดเหตุ', ['class' => 'col-sm-4 col-form-label']) !!} 
        {!! Form::text('accident_date', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
    </div>
    <div class="form-group col-md-5">
        {!! Form::label('ltime', 'เวลาที่เกิดเหตุ', ['class' => 'col-sm-4 col-form-label']) !!} 
        {!! Form::time('accident_time', \Carbon\Carbon::now(),['class' => 'form-control']) !!} 
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('lday2', 'วันที่รายงาน', ['class' => 'col-sm-8 col-form-label']) !!} 
        {!! Form::text('datein', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker2','readonly' => 'true']) !!} 
    </div>
  </div>
    <div class="form-row">
        <div class="form-group col-md-6">
             {!! Form::label('place', 'สถานที่เกิดเหตุ', ['class' => 'col-sm-3 col-form-label']) !!}
             @if ($errors->has('place'))
             <span class="text-danger">* {{ $errors->first('place') }}</span>
             @endif
             {!! Form::text('place',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกสถานที่']) !!} 
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('inputPassword4', 'ผู้ประสบเหตุการณ์', ['class' => 'col-sm-4 col-form-label']) !!} 
            @if ($errors->has('in_person'))
            <span class="text-danger">* {{ $errors->first('in_person') }}</span>
            @endif
            {!! Form::select('in_person', ['บุคลากร' => 'บุคลากร', 'อื่นๆ' => 'อื่นๆ'], null,['class' => 'form-control','placeholder' => 'กรุณาเลือก...','id' => 'target']) !!} 
        </div>
    </div>
    <div class="form-row" id="name_in">
      <div class="form-group col-md-6">
        {!! Form::label('l_name_in', '*กรุณากรอกชื่อบุคลากรผู้ประสบเหตุการณ์', ['class' => 'col-sm-12 col-form-label']) !!} 
        {!! Form::text('name_in',null,["class"=>"form-control",'placeholder'=>'กรุณากรอกชื่อบุคลากรผู้ประสบเหตุการณ์']) !!} 
      </div>
  </div>

    <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">ความเสี่ยงที่เกิดขึ้น</h3>
        </div>
        @if ($errors->has('risk_type'))
        <span class="text-danger">* {{ $errors->first('risk_type') }}</span>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio1" name="risk_type" value="ด้านงานการเงินและงบประมาณ" {{(old('risk_type') == 'ด้านงานการเงินและงบประมาณ') ? 'checked' : ''}}>
                    <label for="customRadio1" class="custom-control-label">ด้านงานการเงินและงบประมาณ</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="risk_type" value="ด้านงานแผน" {{(old('risk_type') == 'ด้านงานแผน') ? 'checked' : ''}}>
                    <label for="customRadio2" class="custom-control-label">ด้านงานแผน</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio3" name="risk_type" value="ด้านงานพัสดุ" {{(old('risk_type') == 'ด้านงานพัสดุ') ? 'checked' : ''}}>
                    <label for="customRadio3" class="custom-control-label">ด้านงานพัสดุ</label>
                  </div>
                </div>
              </div> 
              <div class="col-sm-3">
                <!-- radio -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio4" name="risk_type" value="ด้านงานธุรการ" {{(old('risk_type') == 'ด้านงานธุรการ') ? 'checked' : ''}}>
                    <label for="customRadio4" class="custom-control-label">ด้านงานธุรการ</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio5" name="risk_type" value="ด้านเทคโนโลยีสารสนเทศ" {{(old('risk_type') == 'ด้านเทคโนโลยีสารสนเทศ') ? 'checked' : ''}}>
                    <label for="customRadio5" class="custom-control-label">ด้านเทคโนโลยีสารสนเทศ</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio6" name="risk_type" value="การพัฒนาบุคลากร" {{(old('risk_type') == 'การพัฒนาบุคลากร') ? 'checked' : ''}}>
                    <label for="customRadio6" class="custom-control-label">การพัฒนาบุคลากร</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio7" name="risk_type" value="ด้านงานบริหารรถยนต์ราชการ" {{(old('risk_type') == 'ด้านงานบริหารรถยนต์ราชการ') ? 'checked' : ''}}>
                    <label for="customRadio7" class="custom-control-label">ด้านงานบริหารรถยนต์ราชการ</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio8" name="risk_type" value="ด้านงานสื่อเทคโนโลยีสุขภาพจิต" {{(old('risk_type') == 'ด้านงานสื่อเทคโนโลยีสุขภาพจิต') ? 'checked' : ''}}>
                    <label for="customRadio8" class="custom-control-label">ด้านงานสื่อเทคโนโลยีสุขภาพจิต</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio9" name="risk_type" value="ภัยพิบัติในองค์กร" {{(old('risk_type') == 'ภัยพิบัติในองค์กร') ? 'checked' : ''}}>
                    <label for="customRadio9" class="custom-control-label">ภัยพิบัติในองค์กร</label>
                  </div>
                </div>
              </div> 
              <div class="col-sm-3">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="radio" id="customRadio10" name="risk_type" value="อื่นๆ" {{(old('risk_type') == 'อื่นๆ') ? 'checked' : ''}}>
                    <label for="customRadio10" class="custom-control-label">อื่นๆ</label>
                  </div>
                </div>
              </div> 
            </div>

        <div class="form-row" id="otherDetail">
          <div class="form-group col-md-6">
            {!! Form::label('place', '*อื่นๆ โปรดระบุ', ['class' => 'col-sm-12 col-form-label']) !!} 
            {!! Form::text('other_detail',null,["class"=>"form-control",'placeholder'=>'อื่นๆ โปรดระบุ']) !!} 
          </div>
      </div>

    </div>
    </div>
      
        <!-- /.card-body -->
    
    <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-danger">
            <div class="card-header">
              <h3 class="card-title">
                เหตุการณ์โดยย่อ
                <small>(กรุณาระบุเหตุการณ์โดยย่อ)</small>
              </h3>

              @if ($errors->has('risk_detail'))
              <span class="text-danger"><br>* {{ $errors->first('risk_detail') }}</span>
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
                <textarea name="risk_detail" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('risk_detail')}}</textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
      <div class="input-group mb-3 col-md-4">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile02" name="file_path"/>
            <label class="custom-file-label" for="inputGroupFile02">ไฟล์ที่เกี่ยวข้อง(ถ้ามี)</label>
        </div>
    </div>

      <div class="form-group">
            {!! Form::label('inputAddress', 'การแก้ไขเบื้องต้น', ['class' => 'col-sm-2 col-form-label']) !!} 
              @if ($errors->has('correction'))
              <span class="text-danger"><br>* {{ $errors->first('correction') }}</span>
              @endif
            {!! Form::textarea('correction', null, ['id' => 'keterangan', 'rows' => 3, 'cols' => 54, 'style' => 'resize:none','class' => 'form-control','placeholder'=>'การแก้ไขเบื้องต้น']) !!}
      </div>
    
      <div class="form-row">
        <div class="form-group col-md-4">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">ผลกระทบต่อการปฏิบัติงาน</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
        <label for="customRange1">ระดับความรุนแรง 1 - 5</label>
        <input type="range" min="1" max="5" value="{{ (old("impact_perform")== 1 OR old("impact_perform")==null) ? '1': old("impact_perform") }}"  class="custom-range custom-range-danger" id="customRange1" name="impact_perform"> 
        <span id="range_detail"></span>
                </div>
        </div>
        </div>
        <div class="form-group col-md-4">
            <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">ผลกระทบต่อทรัพย์สินองค์กร</h3>
                </div>
                <?php echo $errors->has('impact_property');?>
                <!-- /.card-header -->
                <div class="card-body">
        <label for="customRange2">ระดับความรุนแรง 1 - 5</label>
        <input type="range" min="1" max="5" value="{{ (old("impact_property")== 1 OR old("impact_property")==null) ? '1': old("impact_property") }}" class="custom-range custom-range-danger" id="customRange2" name="impact_property">
        <span id="range_detail2"></span>
                </div>
        </div>
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('inputAddress', 'ข้อเสนอแนะอื่นๆ เพื่อการแก้ไขป้องกัน', ['class' => 'col-sm-6 col-form-label']) !!} 
        {!! Form::textarea('suggestion', null, ['id' => 'keterangan', 'rows' => 3, 'cols' => 54, 'style' => 'resize:none','class' => 'form-control']) !!}
      </div>
      <p></p>
      <button type="submit" class="btn btn-success">
        <i class="far fa-save"></i> บันทึก
      </button>
      <a href="/contact" class="btn btn-success"><i class="fas fa-arrow-left"></i> กลับ</a>
      <p></p>
{!! Form::close() !!}
</div>

<script>
    $('#datepicker').datepicker({
            locale: 'th-TH',
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
    });

var slider1 = document.getElementById("customRange1");
var output1 = document.getElementById("range_detail");
output1.innerHTML =  "ค่าคะแนน : "+slider1.value;

slider1.oninput = function() {
  output1.innerHTML = "ค่าคะแนน : "+this.value;
}

var slider2 = document.getElementById("customRange2");
var output2 = document.getElementById("range_detail2");
output2.innerHTML = "ค่าคะแนน : "+slider2.value;

slider2.oninput = function() {
  output2.innerHTML = "ค่าคะแนน : "+this.value;
}


            $('#inputGroupFile02').on('change',function(){
                var fileName = $(this).val();
                $(this).next('.custom-file-label').html(fileName);
            })

            $("#name_in").hide(); //ซ่อนช่องกรอกชื่อบุคลากรไว้ก่อน
            $( "#target" ).change(function() {
              var data = $(this).val();
              //alert(data);
              if(data=="บุคลากร"){
                $("#name_in").show(); //แสดงช่องกรอกชื่อบุคลากร
              }else{
                $("#name_in").hide();
              }
            });

        $("#otherDetail").hide(); //ซ่อนช่องกรอกอื่นๆไว้ก่อน
        $(document).ready(function () {                            
        $("#customRadio1,#customRadio2,#customRadio3,#customRadio4,#customRadio5,#customRadio6,#customRadio7,#customRadio8,#customRadio9,#customRadio10").change(function () {
        if ($("#customRadio10").is(":checked")) {
            $("#otherDetail").show(); //แสดงช่องกรอกอื่นๆไว้ก่อน
        }else 
            $("#otherDetail").hide();
    });        
});
</script>

@endsection