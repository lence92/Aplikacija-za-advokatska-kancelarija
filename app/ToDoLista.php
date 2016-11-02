<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/3/2016
 * Time: 9:57 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class ToDoLista extends Model
{

    //
    //restricts columns from modifying
    //protected $guarded = [];
    protected $table = 'todolista';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}