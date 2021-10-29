<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaivanban;
class loaiVanBanController extends Controller
{
    public function index()
    {
        return loaivanban::orderBy('thu_tu')->paginate(10);
    }

    public function indexfontend()
    {
        return loaivanban::where('trang_thai','1')->orderBy('thu_tu')->get();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validateForm($request);
        $loaiVanBan = new loaivanban;
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        return loaivanban::find($id);
    }
    public function update(Request $request, $id)
    {
        $this->validateForm($request);
        $loaivanban = loaivanban::find($id);
        $loaivanban->ten_loai = $request->ten_loai;
        $loaivanban->thu_tu = $request->thu_tu;
        $loaivanban->trang_thai = $request->trang_thai;
        $loaivanban->save();
    }
    public function destroy($id)
    {
        loaivanban::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ten_loai' => 'required',
            'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'ten_loai' => 'Tên loại',
            'thu_tu' => 'Thứ tự'
        ]);
    }
}
