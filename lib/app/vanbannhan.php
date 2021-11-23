<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vanbannhan extends Model
{
    protected $table = 'vanbannhan';
    public function donvigui(){
        return $this->hasOne('App\donvi', 'don_vi_gui')
        ->select('donvi.id','donvi.ky_hieu');
    }
    
}
