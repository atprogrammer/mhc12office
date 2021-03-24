<?php

namespace App\Http\Controllers\Risk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //ใช้ Query มือ
use App\Models\Risk; //เรียก Model

class RiskController extends Controller
{
    public function index()
    {
       //$contacts=Contact::all();
       //$risks=Risk::paginate(5); //แบ่งหน้า
       $risks=Risk::where('user_id', '=',auth()->user()->id)->paginate(10);
       return view('risk.index',[
           'risks'=>$risks
           ]);
    }

    public function create()
    {
        return view('risk.create'); 
      
    }

    public function store(Request $request)
    {
         //dd($request);
         
         //ตรวจสอบข้อมูล
         $request->validate([
            'place'=>'required',
            'in_person'=>'required',
            'risk_type'=>'required',
            'risk_detail'=>'required',
            'correction'=>'required',
            'suggestion'=>'required',
         ],
         [
            'place.required' => 'กรุณากรอกข้อมูลสถานที่',
            'in_person.required' => 'กรุณากรอกข้อมูลผู้ประสบเหตุการณ์',
            'risk_type.required' => 'กรุณาเลือกข้อมูลความเสี่ยงที่เกิดขึ้น',
            'risk_detail.required' => 'กรุณากรอกข้อมูลเหตุการณ์โดยย่อ',
            'correction.required' => 'กรุณากรอกข้อมูลการแก้ไขเบื้องต้น',
            'suggestion.required' => 'กรุณากรอกข้อมูลข้อเสนอแนะ',
         ]);
         //บันทึกข้อมูล
         $accident_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->accident_date)
         ->format('Y-m-d'); //แปลงวันที่ลงฐานข้อมูล
         $risk = new Risk();
         $risk->accident_date = $accident_date;
         $risk->accident_time = $request->accident_time;
         $risk->place = $request->place;
         $risk->in_person = $request->in_person;
         $risk->name_in = $request->name_in;
         $risk->risk_type = $request->risk_type;
         $risk->risk_detail = $request->risk_detail;
         $risk->other_detail = $request->other_detail;
         $risk->file_path = " ";///รอใส่ค่า
         $risk->correction = $request->correction;
         $risk->impact_perform = $request->impact_perform;
         $risk->impact_property = $request->impact_property;
         $risk->suggestion = $request->suggestion;
         $risk->user_id = $request->user_id;
         $risk->save();
         return redirect()->route('risk.index')->with('status','บันทึกข้อมูลเรียบร้อย');



    }

    public function edit($id)
    {
        //
    }
}
