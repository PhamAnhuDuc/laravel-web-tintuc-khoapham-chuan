<?php

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
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('thu', function() {
//     $theloai = TheLoai::find(1);   //lấy theo id = 1
//     //echo $theloai->loaitin;
//     foreach ($theloai->loaitin as $loaitin) { //lấy hết danh sách loại
//     	echo $loaitin->ten . "</br>";
//     }
// });

// Route::get('test', function() {
//     return view('admin.theloai.danhsach');
// });

Route::get('admin/dangnhap', 'UserController@getDangnhapAdmin');
Route::post('admin/dangnhap', 'UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		//admin/theloai/them
		Route::get('danhsach', 'TheLoaiController@getDanhSach');
			//sửa cái nào -> truyền thêm id cho nó
		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');

		Route::get('them', 'TheLoaiController@getThem');
		Route::post('them', 'TheLoaiController@postThem');

		Route::get('xoa/{id}', 'TheLoaiController@postXoa');
	});

	Route::group(['prefix'=>'loaitin'],function(){
		//admin/loaitin/them
		Route::get('danhsach', 'LoaiTinController@getDanhSach');
			//sửa cái nào -> truyền thêm id cho nó
		Route::get('sua/{id}', 'LoaiTinController@getSua');
		Route::post('sua/{id}', 'LoaiTinController@postSua');

		Route::get('them', 'LoaiTinController@getThem');
		Route::post('them', 'LoaiTinController@postThem');

		Route::get('xoa/{id}', 'LoaiTinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'],function(){
		//admin/loaitin/them
		Route::get('danhsach', 'TinTucController@getDanhSach');
		Route::get('sua/{id}', 'TinTucController@getSua');
		Route::post('sua/{id}', 'TinTucController@postSua');
		
		Route::get('them', 'TinTucController@getThem');
		Route::post('them', 'TinTucController@postThem');

		Route::get('xoa/{id}', 'TinTucController@getXoa');
	});

	Route::group(['prefix'=>'slide'],function(){
		//admin/loaitin/them
		Route::get('danhsach', 'SlideController@getDanhSach');
		Route::get('sua/{id}', 'SlideController@getSua');
		Route::post('sua/{id}', 'SlideController@postSua');
		
		Route::get('them', 'SlideController@getThem');
		Route::post('them', 'SlideController@postThem');

		Route::get('xoa/{id}', 'SlideController@getXoa');
	});

	Route::group(['prefix'=>'user'],function(){
		//admin/loaitin/them
		Route::get('danhsach', 'UserController@getDanhSach');
		Route::get('sua/{id}', 'UserController@getSua');
		Route::post('sua/{id}', 'UserController@postSua');
		
		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');

		Route::get('xoa/{id}', 'UserController@getXoa');
	});



	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
	});



	Route::group(['prefix' => 'ajax'], function() {
	    Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
	});
});


// Route::get('trangchu', function() {
//    return view('pages.trangchu');
// });

Route::get('trangchu', 'PagesController@trangchu');

Route::get('lienhe', 'PagesController@lienhe');

Route::get('loaitin/{id}/{TenKhongDau}.html', 'PagesController@loaitin');

Route::get('tintuc/{id}/{TieuDeKhongDau}.html', 'PagesController@tintuc');

Route::get('dangnhap' ,'PagesController@getDangnhap')->name('dangnhap');
Route::post('dangnhap','PagesController@postDangnhap');
Route::get('dangxuat','PagesController@getDangXuat');
Route::post('comment/{id}','CommentController@postComment');

Route::get('nguoidung','PagesController@getNguoidung');
Route::post('nguoidung','PagesController@postNguoidung');

Route::get('dangki','PagesController@getDangki');
Route::post('dangki','PagesController@postDangki');

Route::post('timkiem','PagesController@postTimkiem');