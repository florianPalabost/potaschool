<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvancementExercice extends Model
{
    protected $fillable=['idEleve','idEx','scoreAct','meilleurScore','nbErreur'];
}
