<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeVal extends Model
{

    // Determines which database table to use
    protected $table = 'attribute_vals';
    //
    public $timestamps = false;

    /**
     * A Value belongs to a Definition
     * this funtion returns the definition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function definition(){
        return $this->belongsTo('App\AttributeDef', 'attribute_def_id');
    }


    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requestAttributes(){
        return $this->belongsToMany('App\Request', 'request_attribute', 'attribute_id', 'request_id');
    }
}
