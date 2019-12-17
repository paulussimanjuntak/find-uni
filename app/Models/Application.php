<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['status','applicant_id','programme_id'];

    public function applicant(){
      return $this->belongsTo('App\Models\Applicant');
    }

    public function programme(){
      return $this->belongsTo('App\Models\Programme');
    }

    public function qual_obtained(){
      return $this->hasMany('App\Models\QualObtained');
    }

}
