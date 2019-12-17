<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = ['IDtype','IDnumber','mobileNo','dateOfBirth','user_id'];

    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    public function application(){
      return $this->hasMany('App\Models\Application');
    }

}
