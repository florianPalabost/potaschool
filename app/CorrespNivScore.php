<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrespNivScore extends Model
{
    protected $fillable=['id','scoreMin','scoreMax','niv','rank'];
}
