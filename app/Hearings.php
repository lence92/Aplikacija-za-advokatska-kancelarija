<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hearings extends Model
{
    //
    //restricts columns from modifying
    //protected $guarded = [];
    protected $table = 'hearings';

    public function cases(){
        return $this->belongsTo('App\Cases', 'case_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
