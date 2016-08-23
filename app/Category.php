<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;


    /**
     * A Category can have many requests.
     * Return Request of Category.
     */
    public function requests(){
        return $this->hasMany('App\Request');
    }
}
