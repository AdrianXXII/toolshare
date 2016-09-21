<?php

namespace App;

use Storage;
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
     * Returns the User of the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Returns the Category of the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * Returns the Attributes of the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requestAttributes(){
        return $this->belongsToMany('App\AttributeVal' , 'request_attribute', 'request_id', 'attribute_id');
    }

    /**
     * Retruns the Offers of the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers(){
        return $this->hasMany('App\Offer');
    }

    /**
     * Retruns the selected Offer of the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer(){
        return $this->belongsTo('App\Offer', 'selected_offer');
    }

    /**
     * Gives back the path to the XML file
     * @return string
     */
    public function getXmlPath(){
        return "/xml/$this->id/order.xml";
    }

    /**
     * Make an xml for the Request
     *
     * @return SimpleXMLElement
     */
    public function makeXml(){
        $path = $this->getXmlPath();
        $xml = $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $array = array('recipient' => array(), 'supplier' => array(), 'order' => array());
        $array['recipient']['email'] = $this->user->email;
        $array['recipient']['company'] = $this->user->company;
        $array['recipient']['street'] = $this->user->street;
        $array['recipient']['zip'] = $this->user->zip;
        $array['recipient']['city'] = $this->user->city;
        $array['recipient']['country'] = $this->user->country;

        $array['supplier']['email'] = $this->offer->user->email;
        $array['supplier']['company'] = $this->offer->user->company;
        $array['supplier']['street'] = $this->offer->user->street;
        $array['supplier']['zip'] = $this->offer->user->zip;
        $array['supplier']['city'] = $this->offer->user->city;
        $array['supplier']['country'] = $this->offer->user->country;

        $array['order']['category'] = $this->category->description;
        $array['order']['quantity'] = $this->quantity;
        $array['order']['duedate'] = $this->date;
        $array['order']['price'] = $this->offer->price;

        foreach($this->requestAttributes as $i => $atr){
            $array['order'][$i]['attribute'] = array();
            $array['order'][$i]['attribute']['definition'] = $atr->definition->definition;
            $array['order'][$i]['attribute']['value'] = $atr->value . " " . $atr->definition->unit;
        }

        $this->arrayToXML($array, $xml);
        Storage::put($path,$xml->asXML());
        return $path;
    }

    /**
     * Turns array into xml.
     *
     * based on code from stackoverflow: http://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
     *
     * @param $array
     * @param $xml
     */
    private function arrayToXML($array, &$xml){
        if(is_array($array)){
            foreach($array as $i => $data) {
                if(is_array($data)){
                    if(is_numeric($i)){
                        $i = 'item'.$i;
                    }
                    $subnode = $xml->addChild($i);
                    $this->arrayToXML($data, $subnode);
                } else {
                    $xml->addChild("$i",htmlspecialchars("$data"));
                }
            }
        }
    }

}
