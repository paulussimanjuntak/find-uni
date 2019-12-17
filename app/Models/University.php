<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
  protected $fillable = ['name'];

  public function user(){
    return $this->hasMany('App\Models\User');
  }

  public function programme(){
    return $this->hasMany('App\Models\Programme');
  }

}
