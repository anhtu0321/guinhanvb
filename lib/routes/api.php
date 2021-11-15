<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// api loaivanban
Route::get('/getListLoai','loaiVanBanController@index');
Route::get('/getListLoaiFrontEnd','loaiVanBanController@indexfontend');
Route::get('/getListLoai/{id}','loaiVanBanController@edit');
// api DonVi
Route::get('/getDonVi','DonViController@index');
Route::get('/getDonViNoPage','DonViController@indexnopage');
Route::get('/getDonViCha','DonViController@donvicha');
Route::get('/getDonVi/{id}','DonViController@edit');
// Danh sach chuc nang cha
Route::get('/listChucNangCha','PermissionController@listCha');
// api list Chuc Nang
Route::get('/getListChucNang','PermissionController@index');
Route::get('/getListChucNang/{id}','PermissionController@edit');
// api list Phân quyền
Route::get('/listPhanQuyen','RoleController@index');
Route::get('/editPhanQuyen/{id}','RoleController@edit');
// list chuc nang cha phuc vu quản lý phân quyền
Route::get('/listChucNangCha','PermissionController@listCha');
// api list tài khoản
Route::get('/listTaiKhoan','UserController@index');
Route::get('/editTaiKhoan/{id}','UserController@edit');

// ***************** SỬ DỤNG CHO FORNTEND **************


