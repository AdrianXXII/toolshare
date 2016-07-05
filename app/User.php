<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Eloquent implements Authenticatable
{
    //
    public $timestamps = false;

    protected $fillable = array('email', 'password', 'company', 'street', 'zip', 'city', 'country');
}
