<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradelist extends Model
{
    protected $fillable = ['grade'];

    public function qualification(){
      return $this->belongsTo('App\Models\Qualification');
    }
}
