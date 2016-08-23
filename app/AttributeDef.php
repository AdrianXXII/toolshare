<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeDef extends Model
{
    //
    public $timestamps = false;


    /**
     * A user can have many requests.
     * Return Request of user.
     */
    public function values()
    {
        return $this->hasMany('App\AttributeVal');
    }
}
