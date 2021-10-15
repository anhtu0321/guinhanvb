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
}

