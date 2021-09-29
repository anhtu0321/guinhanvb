<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// api loaivanban
Route::get('/getListLoai','loaiVanBanController@index');
Route::get('/getListLoai/{id}','loaiVanBanController@edit');
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
