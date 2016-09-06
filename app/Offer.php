<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    // Determines which database table to use
    protected $table = 'offers';

    //
    public $timestamps = false;

    // Allowed field to be altered
    protected $fillable = array('price','request_id','supplier_id');

    /**
     * A offer belongs to a User, called a Supplier.
     * This function returns the user of this offer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User' , 'supplier_id');
    }

    /**
     * A offer always belongs to a Request and
     * this function returns the Request of the Offer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request(){
        return $this->belongsTo('App\Request', 'request_id');
    }

    /**
     *
     */
    public function chosenByRequest()
    {
        return $this->hasOne('App\Request');

    }
}
