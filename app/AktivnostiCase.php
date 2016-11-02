<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivnostiCase extends Model
{
    //
    //restricts columns from modifying
    //protected $guarded = [];

    protected $table = "aktivnosticases";
    public function cases(){
        return $this->belongsTo('App\Cases', 'case_id');
    }
}
