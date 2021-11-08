<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vanbangui;
use App\vanbannhan;
class guinhanController extends Controller
{
    // Lấy thông tin id và tên phòng cho mục gửi văn bản các đơn vị
    public function loaddata(Request $request){
        $id = $request->session()->get('id');
        $ten_phong = $request->session()->get('ten_phong');
        return response()->json(['id'=>$id, 'ten_phong'=>$ten_phong],200);
    }

    // Thực hiện gửi văn bản
    public function guivanban(Request $request){
        $vanbangui = new vanbangui;
        $vanbangui->so = $request->so;
        $vanbangui->id_loai_van_ban = $request->loai;
        $vanbangui->do_mat = $request->do_mat;
        $vanbangui->trich_yeu = $request->trich_yeu;
        $vanbangui->don_vi_gui = $request->don_vi_gui;
        $vanbangui->ghi_chu = $request->ghi_chu;
        $vanbangui->ngay_nhap = date('d/m/Y');
        $vanbangui->gio_nhap = date('H:i:s');
        

    }

}
