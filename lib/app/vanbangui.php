<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vanbangui extends Model
{
    protected $table = 'vanbangui';
    public function donvis(){
        return $this->belongsToMany('App\donvi', 'kynhan', 'id_van_ban', 'id_don_vi')
        ->select('donvi.id','donvi.ky_hieu','kynhan.ky_nhan','kynhan.nguoi_nhan','kynhan.sdt','kynhan.ngay_nhan','kynhan.gio_nhan','kynhan.trang_thai');
    }
}
