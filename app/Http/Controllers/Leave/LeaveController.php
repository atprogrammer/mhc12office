<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\LeaveDate;
use Illuminate\Http\Request;
use Redirect; //ใช้งาน json
use Response;

class LeaveController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            // $data = Event::where('id',10)->whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']); //เฉพาะ id
            $data = LeaveDate::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'start', 'end','color']);
            return Response::json($data);

        }


        return view('leave.index', [
            'ch' => 'old',
        ]);

    }

    public function create(Request $request)
    {
        $start = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start)
        ->format('Y-m-d'); //แปลงวันที่ลงฐานข้อมูล
        $end = \Carbon\Carbon::createFromFormat('d/m/Y', $request->end)
        ->format('Y-m-d 12:00:00'); //แปลงวันที่ลงฐานข้อมูล (เพิ่ม 12 เพื่อสร้างเวลาข้ามวัน)

        if($request->title=="ลาป่วย"){
            $color = "yellow";
        }elseif($request->title=="ลาพักผ่อน"){
            $color = "green";
        }

        $insertArr = [
            'title' => $request->title,
            'start' => $start,
            'end' => $end,
            'color' => $color,
        ];
        $event = LeaveDate::insert($insertArr);
        return Response::json($event);

    }

    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = LeaveDate::where($where)->update($updateArr);
 
        return Response::json($event);
    } 

    public function destroy(Request $request)
    {
        $event = LeaveDate::where('id', $request->id)->delete();

        return Response::json($event);
    }

}
