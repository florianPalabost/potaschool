<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDepart extends Model
{
    protected $fillable=['id','idEleve','idMatiere','appreciation','aime'];
}
