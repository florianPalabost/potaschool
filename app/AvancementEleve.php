<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvancementEleve extends Model
{
    protected $fillable=['idEleve','idClasse','idCours','scoreActuel','scoreMax'];
}
