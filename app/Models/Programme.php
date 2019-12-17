<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = ['name','description','closingDate','university_id'];

    public function university(){
      return $this->belongsTo('App\Models\University');
    }

    public function application(){
      return $this->hasMany('App\Models\Application');
    }

}
