<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\donvi;

class DonViController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return donvi::with('donvicha')->orderBy('parent_id','asc')->orderBy('khoi','asc')->orderBy('thu_tu','asc')->paginate(10);
    }

    public function indexnopage()
    {
        return donvi::with('donvicon')->orderBy('thu_tu','asc')->get();
    }

    public function donvicha()
    {
        return donvi::where('parent_id',0)->orderBy('khoi','asc')->orderBy('thu_tu','asc')->get();
    }



    public function store(Request $request)
    {
        $this->validateForm($request);
        $donvi = new donvi;
        $donvi->ten_phong = $request->ten_phong;
        $donvi->ky_hieu = $request->ky_hieu;
        $donvi->mat_khau = "1";
        $donvi->khoi = $request->khoi;
        $donvi->parent_id = $request->parent_id;
        $donvi->thu_tu = $request->thu_tu;
        $donvi->trang_thai = $request->trang_thai;
        $donvi->save();
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        return donvi::find($id);
    }


    public function update(Request $request, $id)
    {
        $this->validateForm($request);
        $donvi = donvi::find($id);
        $donvi->ten_phong = $request->ten_phong;
        $donvi->ky_hieu = $request->ky_hieu;
        if($request->mat_khau != ''){
            $donvi->mat_khau = $request->mat_khau;
        }
        $donvi->khoi = $request->khoi;
        $donvi->parent_id = $request->parent_id;
        $donvi->thu_tu = $request->thu_tu;
        $donvi->trang_thai = $request->trang_thai;
        $donvi->save();
    }

    public function destroy($id)
    {
        donvi::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ten_phong' => 'required',
            'ky_hieu' => 'required',
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
