<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  protected $fillable = ['subjectName','grade','qual_obtained_id'];

  public function qual_obtained(){
    return $this->belongsTo('App\Models\QualObtained');
  }

}
