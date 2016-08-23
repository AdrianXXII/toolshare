<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    public $timestamps = false;

    /**
     * A offer belongs to a User, called a Supplier.
     * This function returns the user of this offer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App/User' , 'supplier_id');
    }

    /**
     * A offer always belongs to a Request and
     * this function returns the Request of the Offer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request(){
        return $this->belongsTo('App/Request', 'request_id');
    }
}
