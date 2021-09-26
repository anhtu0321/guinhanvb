<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class loaivanban extends Model
{
    use softDeletes;
    protected $table = 'loaivanban';
}
