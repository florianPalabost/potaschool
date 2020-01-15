<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  protected $fillable=['name','matiere_id','nomModule','id_niv_mini'];

  public function matiere(){
    return $this->belongsTo('\App\Matiere');
  }

  public function cours(){
    return $this->hasMany('\App\Cours');
  }
}
