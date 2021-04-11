@extends('layouts.admin')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
       
     
        <p><input class="btn btn-primary" type="submit" data-toggle="modal" data-target="#exampleModal" value="เพิ่มวันลา"></p>
        
       
            <div class="alert alert-success" role="alert">
                <h5>ปฏิทินของฉัน</h5>
              </div>

        <div class="response alert alert-success mt-2" style="display: none;"></div>
        <div id='calendar'></div>  
    </div>


    
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
                            <input type="text" name="name" id="name" class="form-control"/>
                        </div>  

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('lday', 'วันที่ลา', ['class' => 'col-sm-4 col-form-label']) !!} 
                                    {!! Form::text('auther_name', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker']) !!} 
                                </div>  
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    {!! Form::label('lday', 'ถึงวันที่', ['class' => 'col-sm-4 col-form-label']) !!} 
                                    {!! Form::text('description', \Carbon\Carbon::now()->format('d/m/Y'),['class' => 'form-control','id' => 'datepicker2']) !!} 
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
                        <div class="form-group">
                            <label>ผู้ตรวจสอบ</label>
                            <input type="text" name="" id="" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>ผู้บังคับบัญชา</label>
                            <input type="text" name="" id="" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>ผู้อนุญาติ</label>
                            <input type="text" name="" id="" class="form-control"/>
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
                eventClick: function (event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/leave/delete',
                            data: "&id=" + event.id,
                            success: function (response) {
                                if(parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
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
