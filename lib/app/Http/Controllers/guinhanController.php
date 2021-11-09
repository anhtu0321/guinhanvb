<?php

namespace App\Http\Controllers;
use App\traits\convertString;
use Illuminate\Http\Request;
use App\vanbangui;
use App\vanbannhan;
class guinhanController extends Controller
{
    use convertString;
    // Lấy thông tin id và tên phòng cho mục gửi văn bản các đơn vị
    public function loaddata(Request $request){
        $id = $request->session()->get('id');
        $ten_phong = $request->session()->get('ten_phong');
        return response()->json(['id'=>$id, 'ten_phong'=>$ten_phong],200);
    }

    // Thực hiện gửi văn bản
    public function guivanban(Request $request){
        $this->validateForm($request);
        $file_url="";
        $duoi_file="";
        if($request->file !=''){
            $thumucluu = public_path('vanbangui/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            if($tenfile !=''){$file_size = $request->file->getSize();}
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile;
            $file_url = $tenfile;
            $duoi_file = $tenduoi;
            $request->file->move($thumucluu, $tenfile);
        }
        $vanbangui = new vanbangui;
        $vanbangui->so = $request->so;
        $vanbangui->id_loai_van_ban = $request->loai;
        $vanbangui->do_mat = $request->do_mat;
        $vanbangui->trich_yeu = $request->trich_yeu;
        $vanbangui->don_vi_gui = $request->don_vi_gui;
        $vanbangui->ghi_chu = $request->ghi_chu;
        $vanbangui->ngay_nhap = date('d/m/Y');
        $vanbangui->gio_nhap = date('H:i:s');
        $vanbangui->save();
        

    }
    public function validateForm(Request $request){
        return $request->validate([
            'trich_yeu' => 'required',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'trich_yeu' => 'Trích yếu',
        ]);
    }

}
