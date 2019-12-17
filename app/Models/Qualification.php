<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
  protected $fillable = ['name','minimumScore','maximumScore','resultCalcDescription','status'];

  public function gradelist(){
    return $this->hasMany('App\Models\Gradelist');
  }

}
