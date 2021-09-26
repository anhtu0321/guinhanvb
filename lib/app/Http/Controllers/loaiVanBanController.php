<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaivanban;
class loaiVanBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return loaivanban::orderBy('thu_tu')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $loaiVanBan = new loaivanban;
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return loaivanban::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateForm($request);
        $loaivanban = loaivanban::find($id);
        $loaivanban->ten_loai = $request->ten_loai;
        $loaivanban->thu_tu = $request->thu_tu;
        $loaivanban->trang_thai = $request->trang_thai;
        $loaivanban->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
