<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class donvi extends Model
{
    use softDeletes;
    protected $table = 'donvi';
    public function donvicha(){
        return $this->belongsTo('App\donvi','parent_id','id')->select('id','ky_hieu');
    }
}
