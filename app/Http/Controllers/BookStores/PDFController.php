<?php

namespace App\Http\Controllers\BookStores;

use App\Http\Controllers\Controller;
use App\Models\BookStore; //use PDF
use Illuminate\Http\Request; //เรียก Model
use Illuminate\Support\Facades\DB; //เรียก Model
use PDF;

//เรียก Model

class PDFController extends Controller
{
    public function pdf($id)
    {

        $books = DB::table('ref_books')
            ->leftJoin('book_outs', 'book_outs.ref_id', '=', 'ref_books.id')
            ->leftJoin('book_stores', 'book_stores.id', '=', 'book_outs.book_id')
            ->select('book_stores.id', 'book_stores.name_book', 'book_outs.volume_book', 'ref_books.in_person')
            ->where('ref_books.id', $id)
            ->get();

        $view = \View::make('book_stores.pdf.report_ref', [
            'books' => $books,
        ]);
        $html_content = $view->render();
        PDF::SetY(10); //ระยะห่างจากด้านบนมาล่าง
        PDF::SetFont('THSarabunNew', 'B', 16, '', 'false');
        PDF::SetTitle("ใบเบิกสื่อ");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('userlist.pdf');

        //dd($books);
    }
}
