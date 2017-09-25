<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class User extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role', 'employee_id', 'office', 'phone_number', 'adress', 'hire_date', 'birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions()
    {
        return $this->hasMany('App\Permissions','user_id');
    }

    public function document_permissions(){
        return $this->hasMany('App\PermissDocuments','user_id');
    }

    public function hearings(){
        return $this->hasMany('App\Hearings', 'user_id');
    }

    public function is_admin()
    {
        $role = $this->role;
        if($role == 'admin')
        {
            return true;
        }
        return false;
    }

    public function is_lawyer(){
        $role = $this->role;
        if($role == 'lawyer' || $role == 'partner')
        {
            return true;
        }
        return false;
    }
}
