<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    //

    //restricts columns from modifying
    //protected $guarded = [];
    protected $table = 'cases';

    public function documents(){
        return $this->hasMany('App\Documents', 'case_id');
    }

    public function hearings(){
        return $this->hasMany('App\Hearings', 'case_id');
    }

}
