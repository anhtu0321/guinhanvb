<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('trangchu');
// backend
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

