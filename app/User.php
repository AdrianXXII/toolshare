<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class User extends Authenticatable
{
    //
    public $timestamps = false;

    protected $fillable = array('email', 'password', 'company', 'street', 'zip', 'city', 'country');
}
