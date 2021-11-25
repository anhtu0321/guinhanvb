<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('trangchu');
// backend
// Lấy danh sách quyền của User login
Route::get('/listPermissionOfUser','UserController@getPermissons');
// đăng nhập trang quản trị admin
Route::group(['prefix'=>'admin'],function(){
    Route::get('/', 'loginController@getLogin')->name('login');
    Route::post('/', 'loginController@postLogin');
    Route::get('/logout','loginController@getLogout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home');
});
// loaivanban
Route::post('/addLoaiVanBan','loaiVanBanController@store');
Route::post('/updateLoaiVanBan/{id}','loaiVanBanController@update');
Route::get('/deleteLoaiVanBan/{id}','loaiVanBanController@destroy');

// Đơn vị
Route::post('/addDonVi','DonViController@store');
Route::post('/updateDonVi/{id}','DonViController@update');
Route::get('/deleteDonVi/{id}','DonViController@destroy');

// Chức năng
Route::post('/addChucNang','PermissionController@store')->middleware('can:chucnang_them');
Route::post('/updateChucNang/{id}','PermissionController@update')->middleware('can:chucnang_sua');
Route::get('/deleteChucNang/{id}','PermissionController@destroy')->middleware('can:chucnang_xoa');

// phân quyền
Route::post('/addPhanQuyen','RoleController@store')->middleware('can:phanquyen_them');
Route::post('/updatePhanQuyen/{id}','RoleController@update')->middleware('can:phanquyen_sua');
Route::get('/deletePhanQuyen/{id}','RoleController@destroy')->middleware('can:phanquyen_xoa');

// Tài khoản
Route::post('/addTaiKhoan','UserController@store')->middleware('can:taikhoan_them');
Route::post('/updateTaiKhoan/{id}','UserController@update')->middleware('can:taikhoan_sua');
Route::get('/deleteTaiKhoan/{id}','UserController@destroy')->middleware('can:taikhoan_xoa');

// FRONTEND ********************************************************************************
// login tai khoan cac don vi
Route::post('/loginDonVi','loginController@logindonvi');
// logout tai khoan cac don vi
Route::get('/logoutdonvi','loginController@logoutdonvi');
// Kiem tra xem co ton tai session khong
Route::get('/checksession', 'loginController@checksession');
// lấy giá trị session
Route::get('/getsession', 'loginController@getsession');
// Tải dữ liệu sau khi login theo đơn vị
Route::get('/guinhantheodonvi', 'guinhanController@loaddata');
// Thực hiện gửi văn bản
Route::post('/guivanban', 'guinhanController@guivanban');
// Thực hiện xóa văn bản đã gửi
Route::get('/delVanBanGui/{id}', 'guinhanController@delvanban');
// api list van ban gui
Route::get('/getListGui','guinhancontroller@listgui');
// api list van ban đã nhận
Route::get('/getListNhan','guinhancontroller@listdanhan');
// api list van ban chưa nhận
Route::get('/getListChuaNhan','guinhancontroller@listchuanhan');
// Ký nhận văn bản
Route::post('/kynhan', 'guinhancontroller@kynhan');
// Thực hiện xóa văn bản đã nhận
Route::get('/delVanBanNhan/{id}', 'guinhanController@delvanbannhan');
