<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
  protected $fillable=['name','content','module_id'];

  public function module(){
    return $this->belongsTo('\App\Module');
  }
}
