<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    protected $fillable = array('password', 'login', 'role_id','l_name', 'f_name', 'country', 'city','confirmation_code');

    protected $table = 'user';

    protected $hidden = array('password', 'remember_token');

	public function role()
    {
        return $this->belongsTo('Role');
    }

    public function mails()
    {
        return $this->hasMany('Email');
    }

    public function pictures()
    {
        return $this->hasMany('Picture');
    }


    public function likes()
    {
        return $this->hasMany('Like');
    }

    public function hasRole($role)
    {
        return strtolower($this->role->name) == strtolower( $role );
    }

    public function hasAnyRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

}
