<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vanbangui extends Model
{
    protected $table = 'vanbangui';
    public function donvis(){
        return $this->belongsToMany('App\donvi', 'kynhan', 'id_van_ban', 'id_don_vi');
    }
}
