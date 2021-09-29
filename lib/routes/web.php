<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('trangchu');
// backend
// Lấy danh sách quyền của User login
Route::get('/listPermissionOfUser','UserController@getPermissons');

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
Route::get('/listTaiKhoan','UserController@index')->middleware('can:taikhoan_xem');
Route::get('/editTaiKhoan/{id}','UserController@edit')->middleware('can:taikhoan_sua');
Route::post('/updateTaiKhoan/{id}','UserController@update')->middleware('can:taikhoan_sua');
Route::get('/deleteTaiKhoan/{id}','UserController@destroy')->middleware('can:taikhoan_xoa');
