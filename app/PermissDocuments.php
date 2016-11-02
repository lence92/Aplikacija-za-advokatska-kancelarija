<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissDocuments extends Model
{
    //
    protected $table = 'document_permissions';

    public function documents(){
        return $this->belongsTo('App\Documents','doc_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
