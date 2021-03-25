<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
//use Dompdf\Dompdf;

class PDFController extends Controller
{
    public function index()
    {
       
    }

    public function pdf()
    {
       
       $pdf = PDF::loadView('pdf.testpdf');
       return @$pdf->stream();
       
 
       
    }
}
