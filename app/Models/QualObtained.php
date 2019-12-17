<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualObtained extends Model
{
  protected $fillable = ['overallScore','application_id','qualification_id'];

  public function application(){
    return $this->belongsTo('App\Models\Application');
  }

  public function qualification(){
    return $this->belongsTo('App\Models\Qualification');
  }
  
  public function result(){
    return $this->hasMany('App\Models\Result');
  }

}
