<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class guinhanController extends Controller
{
    public function loaddata(Request $request){
        $id = $request->session()->get('id');
        $ten_phong = $request->session()->get('ten_phong');
        return response()->json(['id'=>$id, 'ten_phong'=>$ten_phong],200);
    }


}
