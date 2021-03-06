<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiskController; //กำหนดค่าการใช้งาน class
use App\Http\Controllers\BookStoresController; //กำหนดค่าการใช้งาน class
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//BookStores//
Route::get('/bookstores/add/{id?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'index'])->name('bookstores.index');
Route::get('/bookstores/create', [App\Http\Controllers\BookStores\BookStoresController::class, 'add'])->name('bookstores.create');
Route::get('/bookstores/create/old', [App\Http\Controllers\BookStores\BookStoresController::class, 'search_old'])->name('search_old.create');
Route::get('/bookstores/create/old/{id}', [App\Http\Controllers\BookStores\BookStoresController::class, 'add_old'])->name('bookstores.add_old');
Route::get('/bookstores/edit/{id?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'edit'])->name('bookstores.edit');
Route::post('/bookstores/update', [App\Http\Controllers\BookStores\BookStoresController::class, 'update_stores'])->name('bookstores.update_stores');
Route::get('/bookstores/search/{id?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'search_name'])->name('bookstores.search');
Route::post('/bookstores/store', [App\Http\Controllers\BookStores\BookStoresController::class, 'store'])->name('bookstores.store');
Route::post('/bookstores/store_old', [App\Http\Controllers\BookStores\BookStoresController::class, 'store_old'])->name('bookstores.store_old');
Route::get('/bookstores/action/{id?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'action_index'])->name('bookstores.action');
Route::get('/bookstores/action_book/{id?}/{id2?}/{id3?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'action_book'])->name('bookstores.action_book');
Route::post('/bookstores/action/store', [App\Http\Controllers\BookStores\BookStoresController::class, 'action_book_store'])->name('bookstores.action_book_store');
Route::get('/bookstores/form/action', [App\Http\Controllers\BookStores\BookStoresController::class, 'action_book_form'])->name('bookstores.action_book_form');
Route::get('/bookstores/form/destroy/action/{id?}/{id2?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'action_book_destroy'])->name('bookstores.action_book_destroy');
Route::get('/bookstores/pdftest', [App\Http\Controllers\PDFController::class, 'pdf'])->name('bookstores.pdf');
Route::get('/bookstores/report/ref/{id?}', [App\Http\Controllers\BookStores\PDFController::class, 'pdf'])->name('report.ref');
Route::get('/bookstores/old_order/{id?}', [App\Http\Controllers\BookStores\BookStoresController::class, 'old_order'])->name('bookstores.old_order');
//RiskController//
Route::get('/risk', [App\Http\Controllers\Risk\RiskController::class, 'index'])->name('risk.index');
Route::get('/risk/create', [App\Http\Controllers\Risk\RiskController::class, 'create'])->name('risk.create'); //เรียกหน้าฟอร์มบันทึกข้อมูลความเสี่ยง
Route::post('/risk/store', [App\Http\Controllers\Risk\RiskController::class, 'store'])->name('risk.store'); 
Route::get('/risk/edit/{id}', [App\Http\Controllers\Risk\RiskController::class, 'edit'])->name('risk.edit'); //เรียกหน้าฟอร์มบันทึกข้อมูลความเสี่ยง
Route::get('/risk/destroy', [App\Http\Controllers\Risk\RiskController::class, 'destroy'])->name('risk.destroy'); 

//LeaveController//
Route::get('/leave', [App\Http\Controllers\Leave\LeaveController::class, 'index'])->name('leave.index');
Route::post('/leave/create',[App\Http\Controllers\Leave\LeaveController::class,'create'])->name('leave.create');
Route::post('/leave/update',[App\Http\Controllers\Leave\LeaveController::class,'update']);
Route::post('/leave/delete',[App\Http\Controllers\Leave\LeaveController::class,'destroy']);
Route::post('/leave/add',[App\Http\Controllers\Leave\LeaveController::class, 'store'])->name('leave.store');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
 });
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
