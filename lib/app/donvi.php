<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class donvi extends Model
{
    use softDeletes;
    protected $table = 'donvi';
    public function donvicha(){
        return $this->belongsTo('App\donvi','parent_id','id');
    }
    public function donvicon(){
        return $this->hasMany('App\donvi','parent_id','id')->select('parent_id','id','ky_hieu','ten_phong');
    }
}
