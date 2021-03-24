$(document).ready(function()
{
    $('.deleteForm').click(function(evt){
        evt.preventDefault();
        var name = $(this).data("name"); //รับค่า ID จากฟอร์ม
        var form = $(this).closest("form"); //รับค่า Form จากฟอร์ม
        swal({
            title:'ต้องการลบข้อมูลรหัส '+name+' หรือไม่ ?',
            text:"ลบแล้วไม่สามารถกู้คืนได้",
            icon:"warning",
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        });
    });
});