<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF; //use PDF

class PDFController extends Controller
{
    public function index()
    {
       
    }

    public function pdf()
    {
       
        // PDF::AddPage('L', 'A4');
       
        // PDF::SetFont('THSarabunNew', 'B', 20, '', 'false');
        // PDF::SetY(15);  //ระยะห่างจากด้านบนมาล่าง
        // PDF::SetX(0);  //ระยะห่างจากซ้ายไปขวา
        // PDF::Cell(0, 0, 'อีสานเดฟ มหาสารคาม', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        // PDF::SetFont('THSarabunNew', 'B', 16, '', 'false');
        // PDF::SetY(30);  //ระยะห่างจากด้านบนมาล่าง
        // PDF::SetX(10);  //ระยะห่างจากซ้ายไปขวา
        // PDF::Cell(0, 0, 'วัน/เดือน/ปี', 1, false, 'C', 0, '', 0, false, 'M', 'M');

        // PDF::SetFont('THSarabunNew', 'B', 16, '', 'false');
        // PDF::SetY(34);  //ระยะห่างจากด้านบนมาล่าง
        // PDF::SetX(10);  //ระยะห่างจากซ้ายไปขวา
        // PDF::MultiCell(40, 5, 'เดือน/ปี', 1, 'C',0, 1, '', '', true);

        // PDF::Output('PDF-Report.pdf','I');
      
        $view = \View::make('pdf.testpdf',[
            'data'=>'สวัสดีครับ'
            ]);
        $html_content = $view->render();
        PDF::SetY(10);  //ระยะห่างจากด้านบนมาล่าง
        PDF::SetFont('THSarabunNew', 'B', 16, '', 'false');
        PDF::SetTitle("ใบเบิกสื่อ");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('userlist.pdf');    
    }
}
