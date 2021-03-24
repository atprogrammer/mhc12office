<?php

namespace App\Http\Controllers\BookStores;

use App\Http\Controllers\Controller;
use App\Models\BookAdd;
use App\Models\BookBook; //ใช้ Query มือ
use App\Models\BookStore; //เรียก Model
use App\Models\RefBook; //เรียก Model
use App\Models\Risk; //เรียก Model
use App\Models\Test; //เรียก Model
use Illuminate\Http\Request; //เรียก Model

use Illuminate\Support\Facades\DB;

//เรียก Model

class BookStoresController extends Controller
{

    public function index()
    {

        $books = $this->get_book_3table();
        return view('book_stores.index', [
            'books' => $books,
        ]);
    }

    public function add()
    {
        return view('book_stores.create', [
            'ch' => 'new',
        ]);
    }

    public function search_old()
    {

        $books = $this->get_book_3table();

        return view('book_stores.create', [
            'books' => $books,
            'ch' => 'old',
        ]);

    }

    public function add_old($id)
    {
        $books = DB::table('book_stores')->where('id', $id)->get();
        return view('book_stores.create_old', [
            'books' => $books,
        ]);

    }

    public function store_old(Request $request)
    {
        // dd($request);
        //ตรวจสอบข้อมูล
        $request->validate([

            'book_volume' => 'required|numeric',
            'file_doc' => 'max:5120', //5MB
        ],
            [
                'name_book.required' => 'กรุณากรอกชื่อสื่อ',
            ]);

        if ($request->file_doc) { //เช็คว่ามีการอัพรูปเข้ามาหรือไม่
            $file_doc = $request->file('file_doc');
            //Generate ชื่อไฟล์
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลไฟล์
            $doc_ext = strtolower($file_doc->getClientOriginalExtension());
            $doc_name = $name_gen . '.' . $doc_ext;
            //อัพโหลดไฟล์
            $upload_location = 'document/book/';
            $full_path_doc = $upload_location . $doc_name;
            $file_doc->move($upload_location, $doc_name);
        } else {
            $full_path_doc = null;
        }

        $book_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->book_date);
        $book = new BookAdd();
        $book->book_id = $request->book_id;
        $book->book_date = $book_date;
        $book->book_volume = $request->book_volume;
        $book->book_file = $full_path_doc;
        $book->save();
        return redirect()->route('bookstores.index')->with('status', 'บันทึกข้อมูลเรียบร้อย');

    }

    public function search_name($name = null)
    {
        if ($name != "") {
            //$books = DB::table('book_stores')->where('name_book', 'like', '%'.$name.'%')->paginate(15);
            $books = DB::table('book_stores')
                ->select('book_stores.*', 'book_adds.*', 'book_books.*', (DB::raw('(SELECT (book_volume-sum_test_book)) as total')))
                ->leftJoin(DB::raw('(SELECT book_id, SUM(book_volume) as book_volume
         FROM book_adds GROUP BY book_id)
         book_adds'),
                    function ($join) {
                        $join->on('book_stores.id', '=', 'book_adds.book_id');
                    })
                ->leftJoin(DB::raw('(SELECT book_id as test_book_id, SUM(volume_book) as sum_test_book
         FROM book_books GROUP BY book_id)
         book_books'),
                    function ($join) {
                        $join->on('book_stores.id', '=', 'book_books.test_book_id');
                    })
                ->where('name_book', 'like', '%' . $name . '%')
                ->paginate(15);
            //$books =BookStore::Where('name_book', 'like', '%'.$name.'%')->paginate(15);
        } else {
            //$books=BookStore::paginate(5); //แบ่งหน้า
            $books = $this->get_book_3table();

        }
        return view('book_stores.create', [
            'books' => $books,
            'ch' => 'old',
        ]);
        //dd($books);

    }

    public function store(Request $request)
    {
        //dd($request);
        //ตรวจสอบข้อมูล
        $request->validate([
            'name_book' => 'required',
            'book_type' => 'required',
            'book_unit' => 'required',
            'book_volume' => 'required|numeric',
            'book_from' => 'required',
            'file_image' => 'max:2560|mimes:jpg,jpeg,png',
            'file_doc' => 'max:5120', //5MB
        ],
            [
                'name_book.required' => 'กรุณากรอกชื่อสื่อ',
            ]);

        //การเข้ารหัสรูปภาพ
        if ($request->file_image) { //เช็คว่ามีการอัพรูปเข้ามาหรือไม่
            $file_image = $request->file('file_image');
            //Generate ชื่อภาพ
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($file_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            //อัพโหลดภาพ
            $upload_location = 'images/book/';
            $full_path = $upload_location . $img_name;
            $file_image->move($upload_location, $img_name);
        } else {
            $full_path = null;
        }

        if ($request->file_doc) { //เช็คว่ามีการอัพรูปเข้ามาหรือไม่
            $file_doc = $request->file('file_doc');
            //Generate ชื่อไฟล์
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลไฟล์
            $doc_ext = strtolower($file_doc->getClientOriginalExtension());
            $doc_name = $name_gen . '.' . $doc_ext;
            //อัพโหลดไฟล์
            $upload_location = 'document/book/';
            $full_path_doc = $upload_location . $doc_name;
            $file_doc->move($upload_location, $doc_name);
        } else {
            $full_path_doc = null;
        }
        //บันทึกข้อมูล

        $book_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->book_date)
            ->format('Y-m-d'); //แปลงวันที่ลงฐานข้อมูล
        $book = new BookStore();
        $book->user_id_add = $request->user_id;
        $book->name_book = $request->name_book;
        $book->book_image = $full_path;
        $book->book_storage = $request->book_storage;
        $book->book_type = $request->book_type;
        $book->book_from = $request->book_from;
        $book->book_detail = $request->book_detail;
        $book->book_unit = $request->book_unit;
        $book->save();
        $last_id = $book->id; //ดึงค่า ID ล่าสุด

        $book = new BookAdd();
        $book->book_id = $last_id;
        $book->book_date = $book_date;
        $book->book_volume = $request->book_volume;
        $book->book_file = $full_path_doc;
        $book->save();
        return redirect()->route('bookstores.index')->with('status', 'บันทึกข้อมูลเรียบร้อย');

    }

    public function action_index($name = null)
    {

        if ($name != "") {
            //$books = DB::table('book_stores')->where('name_book', 'like', '%'.$name.'%')->paginate(15);

            $books = DB::table('book_stores')
                ->select('book_stores.*', 'book_adds.*', 'book_books.*', (DB::raw('(SELECT (book_volume-sum_test_book)) as total')))
                ->leftJoin(DB::raw('(SELECT book_id, SUM(book_volume) as book_volume
         FROM book_adds GROUP BY book_id)
         book_adds'),
                    function ($join) {
                        $join->on('book_stores.id', '=', 'book_adds.book_id');
                    })
                ->leftJoin(DB::raw('(SELECT book_id as test_book_id, SUM(volume_book) as sum_test_book
         FROM book_books GROUP BY book_id)
         book_books'),
                    function ($join) {
                        $join->on('book_stores.id', '=', 'book_books.test_book_id');
                    })
                ->where('name_book', 'like', '%' . $name . '%')
                ->paginate(15);

            //$books =BookStore::Where('name_book', 'like', '%'.$name.'%')->paginate(15);
        } else {
            //$books=BookStore::paginate(5); //แบ่งหน้า

            $books = $this->get_book_3table();

        }

        return view('book_stores.action', [
            'books' => $books,
        ]);

    }

    public function action_book($amount, $id, $user_id)
    {

        $book = new BookBook();
        $book->book_id = $id;
        $book->user_id = $user_id;
        $book->volume_book = $amount;
        $book->save();
        $last_id = $book->id; //ดึงค่า ID ล่าสุด
        return redirect()->route('bookstores.action_book_form', $user_id);

    }

    public function action_book_form($user_id)
    {
        //echo  $last_id;
        $books = DB::table('book_stores')
            ->leftJoin('book_books', 'book_stores.id', '=', 'book_books.book_id')
            ->where('user_id', $user_id)
            ->get();
        //$books = DB::table('book_stores')->where('user_id', $user_id)->get();
        return view('book_stores.action_create', [
            'books' => $books,
        ]);


        //echo $customers = DB::table('book_books')->where('user_id', $user_id)->count();

    }

    public function action_book_destroy($book_id, $user_id)
    {

        DB::table('book_books')->where('id', '=', $book_id)->delete();
        $books = DB::table('book_stores')
            ->leftJoin('book_books', 'book_stores.id', '=', 'book_books.book_id')
            ->where('user_id', $user_id)
            ->get();
         //$books = DB::table('book_books')->where('user_id', $user_id)->get();
        return view('book_stores.action_create', [
            'books' => $books,
        ]);

    }

    public function action_book_store(Request $request)
    {

        $post = new RefBook();
        $post->user_id = $request->user_id;
        $post->save();
        $last_id = $post->id; //ดึงค่า ID ล่าสุด

        $input = $request->all();
        $data = $input['addmore'];

        foreach ($data as $value) {
            $post = new Test();
            $post->ref_id = $last_id;
            $post->book_id = $value['book_id'];
            $post->volume_book = $value['volume_book'];
            $post->save();
        }

        DB::table('book_books')->where('user_id', '=', $request->user_id)->delete();
        dd('Post created successfully.');


    }

    public function get_book_3table()
    {
        $books = DB::table('book_stores')
            ->select('book_stores.*', 'book_adds.*', 'book_books.*', (DB::raw('(SELECT (book_volume-sum_test_book)) as total')))
            ->leftJoin(DB::raw('(SELECT book_id, SUM(book_volume) as book_volume
      FROM book_adds GROUP BY book_id)
      book_adds'),
                function ($join) {
                    $join->on('book_stores.id', '=', 'book_adds.book_id');
                })
            ->leftJoin(DB::raw('(SELECT book_id as test_book_id, SUM(volume_book) as sum_test_book
      FROM book_books GROUP BY book_id)
      book_books'),
                function ($join) {
                    $join->on('book_stores.id', '=', 'book_books.test_book_id');
                })
            ->paginate(15);

        return $books;

    }

}
