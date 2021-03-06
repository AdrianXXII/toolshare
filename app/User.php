<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    // Determines which database table to use
    protected $table = 'users';

    //
    public $timestamps = false;

    protected $fillable = array('email', 'password', 'company', 'street', 'zip', 'city', 'country');

    /**
     * A user can have many requests.
     * Return Request of user.
     */
    public function requests(){
        return $this->hasMany('App\Request');
    }

    /**
     * A user can have many requests.
     * Return Request of user.
     */
    public function offers(){
        return $this->hasMany('App\Offer', 'supplier_id');
    }


}
