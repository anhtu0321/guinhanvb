<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kynhan extends Model
{
    protected $table = 'kynhan';
    public function vanbannhans(){
        return $this->belongsTo('App\vanbannhan','id_van_ban_nhan');
    }
}
