<?php

namespace App\Http\Controllers;
use App\traits\convertString;
use Illuminate\Http\Request;
use App\vanbangui;
use App\vanbannhan;
use App\kynhan;
use DB;
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
                
        try{
            DB::beginTransaction();
                $vanbangui = new vanbangui;
                $vanbangui->so = $request->so;
                $vanbangui->id_loai_van_ban = $request->loai;
                $vanbangui->do_mat = $request->do_mat;
                $vanbangui->trich_yeu = $request->trich_yeu;
                $vanbangui->don_vi_gui = $request->session()->get('id');
                $vanbangui->ghi_chu = $request->ghi_chu;
                $vanbangui->file = $file_url;
                $vanbangui->ngay_nhap = date('d/m/Y');
                $vanbangui->gio_nhap = date('H:i:s');
                $vanbangui->save();
                
                $vanbannhan = new vanbannhan;
                $vanbannhan->so = $request->so;
                $vanbannhan->id_loai_van_ban = $request->loai;
                $vanbannhan->do_mat = $request->do_mat;
                $vanbannhan->trich_yeu = $request->trich_yeu;
                $vanbannhan->don_vi_gui = $request->session()->get('id');
                $vanbannhan->ghi_chu = $request->ghi_chu;
                $vanbannhan->file = $file_url;
                $vanbannhan->ngay_nhap = date('d/m/Y');
                $vanbannhan->gio_nhap = date('H:i:s');
                $vanbannhan->save();
                foreach($request->donvinhan as $key=>$value){
                    DB::table('kynhan')->insert([
                        'id_van_ban' => $vanbangui->id,
                        'id_van_ban_nhan' => $vanbannhan->id,
                        'id_don_vi' => $value,
                    ]);
                }
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
        }
    }
    // danh sách văn bản gửi
    public function listgui(Request $request){
        $data = vanbangui::with('donvis')
                    ->where('don_vi_gui', $request->session()->get('id'))
                    ->orderBy('id','desc')
                    ->paginate(10);
        return $data;
    }
    // xóa văn bản gửi
    public function delvanban($id){
        vanbangui::destroy($id);
    }
    // danh sách văn bản chưa nhận
    public function listchuanhan(Request $request){
        $data = DB::table('kynhan')
                ->join('vanbannhan','kynhan.id_van_ban_nhan','=','vanbannhan.id')
                ->join('donvi','vanbannhan.don_vi_gui','=','donvi.id')
                ->leftJoin('loaivanban','loaivanban.id','=','vanbannhan.id_loai_van_ban')
                ->select('kynhan.id','donvi.ky_hieu','vanbannhan.so','loaivanban.ten_loai','vanbannhan.id_loai_van_ban','vanbannhan.do_mat','vanbannhan.trich_yeu','vanbannhan.ghi_chu','vanbannhan.file','vanbannhan.ngay_nhap','vanbannhan.gio_nhap')
                ->where('kynhan.id_don_vi','=',$request->session()->get('id'))
                ->where('kynhan.ky_nhan','=',null)
                ->get();
        return $data;
    }
    // danh sách văn bản đã nhận
    public function listdanhan(Request $request){
        $data = DB::table('kynhan')
                ->join('vanbannhan','kynhan.id_van_ban_nhan','=','vanbannhan.id')
                ->join('donvi','vanbannhan.don_vi_gui','=','donvi.id')
                ->leftJoin('loaivanban','loaivanban.id','=','vanbannhan.id_loai_van_ban')
                ->select('kynhan.id','kynhan.nguoi_nhan','donvi.ky_hieu','vanbannhan.so','loaivanban.ten_loai','vanbannhan.id_loai_van_ban','vanbannhan.do_mat','vanbannhan.trich_yeu','vanbannhan.ghi_chu','vanbannhan.file','vanbannhan.ngay_nhap','vanbannhan.gio_nhap')
                ->where('kynhan.id_don_vi','=',$request->session()->get('id'))
                ->where('kynhan.ky_nhan','=','1')
                ->where('kynhan.trang_thai','=',null)
                ->paginate(20);
        return $data;
    }
    // Ký nhận văn bản
    public function kynhan(Request $request){
        $this->validateKyNhan($request);
        foreach($request->vanbannhan as $key => $value){
            DB::table('kynhan')
            ->where('id',$value)
            ->update([
                'nguoi_nhan' => $request->hoten,
                'sdt' => $request->sdt,
                'ky_nhan' => '1'
            ]);
        };
    }
    // xóa văn bản nhận
    public function delvanbannhan($id){
        DB::table('kynhan')
            ->where('id',$id)
            ->update([
                'trang_thai' =>'1',
            ]); 
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
    public function validateKyNhan(Request $request){
        return $request->validate([
            'hoten' => 'required',
            'sdt' => 'required|numeric|min:6|max:12',

        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là số điện thoại.',
            'min' => ':attribute ít hơn số ký tự tối thiểu.',
            'max' => ':attribute nhiều hơn số ký tự tối đa.',
        ],
        $attributes = [
            'hoten' => 'Họ tên',
            'sdt' => 'Số điện thoại',
        ]);
    }

}
