<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\donvi;
class loginController extends Controller
{
    public function getLogin(){
        if(Auth::check()){return redirect()->route('home');}
        return view('login');
    }
    public function postLogin(Request $request){
        if($request->remember == "remember"){
            $remember = true;
        }else{
            $remember = false;
        }
        $credentials = [
            'username' => $request->username, 
            'password' => $request->password,
        ];  
        if(Auth::attempt($credentials,$remember)){
            return redirect()->route('home');
        }else{
            $request->session()->flash('error','Tài khoản hoặc mật khẩu không đúng !');
            return redirect()->route('login');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function getUser(){
        return Auth::user();
    }
    // sử dụng cho các đơn vị đăng nhập
    public function logindonvi(Request $request){
        $data = donvi::find($request->id);
        if($data->mat_khau == $request->password){
            $request->session()->put(['id'=>$data->id, 'ten_phong'=>$data->ten_phong]);
            return response()->json(['thành công'=>'thành công'],200);
        }else{
            return response()->json(['error'=>'Mật khẩu không đúng !'],401);
        }
    }
    // logout don vi
    public function logoutdonvi(Request $request){
        $request->session()->forget('id');
        $request->session()->forget('ten_phong');
    }
    // kiem tra xe co ton tai session don vi khong
    public function checksession(Request $request){
        if($request->session()->has('id')){
            return response()->json(['thành công'=>'thành công !'],200);
        }else{
            return response()->json(['error'=>'Lỗi! Chưa đăng nhập !'],401);
        }
    }
    // lấy giá trị session
    public function getsession(Request $request){
        $id="";
        $ten_phong="";
        if($request->session()->has('id') && $request->session()->has('ten_phong')){
            $id = $request->session()->get('id');
            $ten_phong = $request->session()->get('ten_phong');
        }
        return response()->json(['id'=>$id, 'ten_phong'=>$ten_phong], 200);
    }
}

