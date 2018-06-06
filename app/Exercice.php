<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected $fillable =['id','idCours','titre','enonce'];
}
