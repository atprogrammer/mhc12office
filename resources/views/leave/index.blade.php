@extends('layouts.admin')
@section('content')

{{-- <style type="text/css">
    #calendar{
        margin: 0 auto;
        font-size:16px;
    }        
    </style> --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
       
       
            <div class="alert alert-success" role="alert">
                <h5>ปฏิทินของฉัน</h5>
              </div>

        <div class="response alert alert-success mt-2" style="display: none;"></div>
        <div class="row">
            <div class="col">
                <p><input class="btn btn-primary" type="submit" data-toggle="modal" data-target="#exampleModal" value="เพิ่มวันลา"></p>
                <div class="card " >
                    <div class="card-header bg-primary">
                      <center> แถบสีสถานะ  </center>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item bg-warning">ลาป่วย</li>
                      <li class="list-group-item bg-success">ลาพักผ่อน</li>
                    </ul>
                  </div>  
            </div>
            <div class="col-10">
                <div  id='calendar' style='border-radius:10px;border:0.5px solid rgb(24, 148, 30);background:#FFF'></div>  
            </div>
        </div>
    </div>
    <br>


    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 45%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">กรุณากรอกข้อมูลการลา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form class="image-upload" method="post" action="" enctype="multipart/form-data">
                        @csrf   
                        <div class="form-group">
                            <label>ประเภทการลา</label>
                            {{-- <input type="text" name="name" id="name" class="form-control"/> --}}
                              <select class="form-control" id="name" name="name">
                                <option value="ลาป่วย">ลาป่วย</option>
                                <option value="ลาพักผ่อน">ลาพักผ่อน</option>
                              </select>
                        </div>  

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('lday', 'วันที่ลา', ['class' => 'col-sm-4 col-form-label']) !!} 
                                    {!! Form::text('datepicker', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
                                </div>  
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('lday', 'ถึงวันที่', ['class' => 'col-sm-4 col-form-label']) !!} 
                                    {!! Form::text('datepicker2', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker2']) !!} 
                                </div>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label>ที่อยู่ติดต่อ</label>
                            <textarea name="" class="textarea form-control" id="" cols="40" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>เบอร์โทรติดต่อ</label>
                            <input type="text" name="" id="" class="form-control"/>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>ผู้ตรวจสอบ</label>
                                      <select class="form-control" id="" name="">
                                        <option value="">#########</option>
                                        <option value="">#########</option>
                                      </select>
                                </div>  
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>ผู้บังคับบัญชา</label>
                                      <select class="form-control" id="" name="">
                                        <option value="">{{$ch}}</option>
                                        <option value="">#########</option>
                                      </select>
                                </div>  
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>ผู้อนุญาติ</label>
                                    <select class="form-control" id="" name="">
                                        <option value="">#########</option>
                                        <option value="">#########</option>
                                      </select>
                                </div>  
                            </div>
                        </div>  
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="formSubmit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var SITEURL = "{{url('/')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/leave",
                displayEventTime: true,
                editable: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                   
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                       // alert(start);
                        $.ajax({
                            url: SITEURL + "/leave/create",
                            data: 'title=' + title + '&start=' + start + '&end=' + end,
                            type: "POST",
                            success: function (data) {
                                displayMessage("Added Successfully");
                                $('#calendar').fullCalendar('removeEvents');
                                $('#calendar').fullCalendar('refetchEvents' );
                            }
                        });
                        calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                        true
                                );
                    }
                    calendar.fullCalendar('unselect');
                },
                 
                eventDrop: function (event, delta) {
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: SITEURL + '/leave/update',
                                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                                type: "POST",
                                success: function (response) {
                                    displayMessage("Updated Successfully");
                                }
                            });
                        },
                // eventClick: function (event) {
                //     var deleteMsg = confirm("Do you really want to delete?");
                //     if (deleteMsg) {
                //         $.ajax({
                //             type: "POST",
                //             url: SITEURL + '/leave/delete',
                //             data: "&id=" + event.id,
                //             success: function (response) {
                //                 if(parseInt(response) > 0) {
                //                     $('#calendar').fullCalendar('removeEvents', event.id);
                //                     displayMessage("Deleted Successfully");
                //                 }
                //             }
                //         });
                //     }
                // },
                ///////สร้าง pop up แสดงกิจกรรม//////
                eventClick: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "DD-MM-Y");
                    var end = $.fullCalendar.formatDate(event.end, "DD-MM-Y");
                    
                Swal.fire('กิจกรรม',event.title+'\nวันที่ '+start+' ถึงวันที่ '+end) 

                // Swal.fire({
                //         icon: 'success',
                //         background: event.color,//ใส่สี backgroud
                //         title: 'กิจกรรม',
                //         text: event.title+'\nวันที่ '+start+' ถึงวันที่ '+end,
                //         footer: '<a href>Why do I have this issue?</a>'
                //         })    
               
                  }


            });
        });
     
        function displayMessage(message) {
            $(".response").css('display','block');
            $(".response").html(""+message+"");
            setInterval(function() { $(".response").fadeOut(); }, 4000);
        }
        

       //////////////////////// //modal//////////////////////
        $(document).ready(function(){
            //var SITEURL = "{{url('/')}}"; 
            //var end = moment($('#datepicker2').val()).format('YYYY-MM-DD 12:00:00');//เพิ่มเวลา 12.00
            $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                            url: "{{route('leave.create')}}",
                            data: 'title=' + $('#name').val() + '&start=' + $('#datepicker').val() + '&end=' + $('#datepicker2').val(),
                            type: "POST",
                            success: function (data) {
                                displayMessage("Added Successfully");
                                $('#calendar').fullCalendar('removeEvents');
                                $('#calendar').fullCalendar('refetchEvents' );
                                alert('เพิ่มข้อมูลสำเร็จ');
                              
                                $('#exampleModal').modal('hide');
                    
                            }
                        });

            });
        });

        


        
    </script>

    
<script>
    $('#datepicker').datepicker({
            locale: 'th-TH',
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
    });

    $('#datepicker2').datepicker({
            locale: 'th-TH',
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
    });
</script>

@endsection
