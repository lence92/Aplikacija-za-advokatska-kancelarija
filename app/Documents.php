<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    //restricts columns from modifying
    //protected $guarded = [];
    protected $table = 'documents';

    public function cases(){
        return $this->belongsTo('App\Cases', 'case_id');
    }

    public function document_permissions(){
        return $this->hasMany('App\PermissDocuments', 'doc_id');
    }
}
