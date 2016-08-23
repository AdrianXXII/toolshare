<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    // Determines which database table to use
    protected $table = 'requests';

    //
    public $timestamps = false;

    // Allowed field to be altered
    protected $fillable = array('category_id', 'quantity', 'date');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requestAttributes(){
        return $this->belongsToMany('App\AttributeVal' , 'request_attribute', 'request_id', 'attribute_id');
    }
}
