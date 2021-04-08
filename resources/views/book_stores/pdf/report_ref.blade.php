<div align="center" > <h1>ใบเบิกสื่อ</h1></div>
  <table border="0" cellpadding="2" width="100%" style="margin-bottom: 100px;">
  
         <tr>
            <td><u>เรื่อง</u> ขอสนับสนุนสื่อเทคโนโลยีสุขภาพจิต</td>
            <td ></td>
            <td ></td>
         </tr>
          <tr>
            <td><u>เรียน</u> ผู้อำนวยการศูนย์สุขภาพจิตที่ 12</td>
            <td ></td>
            <td ></td>
          </tr>
          <tr>
            <td width="60%">ด้วยฝ่ายบริหารทั่วไป ศูนย์สุขภาพจิตที่ 12</td>
            <td ></td>
            <td ></td>
          </tr>
          <tr>
            <td width="100%">มีความประสงค์จะขอรับการสนับสนุนสื่อต่างๆ  เพื่อใช้ {{$books[0]->objective}} </td>
            <td ></td>
            <td ></td>
          </tr>

         
        {{-- <img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:50px;"> --}}
</table>

  <table border="1" cellpadding="2" width="100%" style="margin-bottom: 100px;">
      <tr>
          <th width="10%" align="center">รหัส</th>
          <th width="75%" align="center">รายการ</th>
          <th width="15%" align="center">จำนวน</th>
      </tr>
      @foreach ($books as $book)
           <tr>
              <td align="center">{{$book->id}}</td>
              <td > {{$book->name_book}}</td>
              <td align="center">{{$book->volume_book}} เล่ม</td>
           </tr>
      @endforeach
            <br>
          {{-- <img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:50px;"> --}}
  </table>
<p>
  <table border="0" cellpadding="2" width="100%" style="margin-bottom: 100px;">
  
    <tr>
       <td></td>
       <td ></td>
       <td align="center"><img src="{{asset('images/book/title/title.png')}}" alt="" style="width:60px;height:20px;"> :ผู้ขอเบิก</td>
    </tr>
     <tr>
       <td></td>
       <td ></td>
       <td align="center">( {{Auth::user()->name}} )</td>
     </tr>
     <tr>
      <td></td>
      <td ></td>
      <td align="center">17/02/2564</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td align="center">ได้รับเอกสารดังกล่าวเรียบร้อยแล้ว</td>
    </tr>
    <tr>
      <td align="center">อนุมัติ</td>
      <td ></td>
      <td align="center"><img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:20px;">:ผู้รับเอกสาร</td>
    </tr>
    <tr>
      <td align="center"><img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:20px;"></td>
      <td ></td>
      <td align="center">(นายวิทยา หาดดี)</td>
    </tr>
    <tr>
      <td align="center">(นางสาวลลิภัทร  บัวทอง)</td>
      <td ></td>
      <td align="center">17/02/2564</td>
    </tr>
    <tr>
      <td align="center">นักจิตวิทยาคลินิกชำนาญการ</td>
      <td ></td>
      <td align="center"><img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:20px;">:ผู้จ่าย</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td align="center">(นายกนกศักดิ์  ศักดิ์คำแหง)</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td align="center">17/02/2564</td>
    </tr>
    
    
   {{-- <img src="{{asset('images/book/title/title.png')}}" alt="" style="width:50px;height:50px;"> --}}
</table>