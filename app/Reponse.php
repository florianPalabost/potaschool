<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable =['id','idExo','typeRep','reponse','choix2','choix3','choix4'];
}
