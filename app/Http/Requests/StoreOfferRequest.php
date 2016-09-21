<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreOfferRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Gibt die Fehlermeldungen zurück
     * @return array
     */
    public function messages()
    {
        return [
            'price.required' => 'Die Angebot Preis muss angegeben werden!',
            'price.numeric' => 'Die Angebot Preis muss eine Zahl sein!',
            'price.min' => 'Die Angebot Preis muss grösser sein als CHF 0.05!'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|min:0.05'
        ];
    }
}
