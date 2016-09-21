<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'quantity.required' => 'Die Anzahl muss angegeben werden!',
            'quantity.numeric' => 'Die Anzahl muss eine Zahl sein!',
            'quantity.min' => 'Die Anzahl muss grösser sein als 0!',
            'date.required' => 'Das Lieferdatum muss angegeben werden!',
            'date.date' => 'Das Lieferdatum muss Datum sein!',
            'date.after' => 'Das Lieferdatum darf nicht in der Vergangenheit liegen!'
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
            'category_id' => 'required|numeric',
            'attribute1' => 'required|numeric',
            'attribute2' => 'numeric',
            'attribute3' => 'numeric',
            'quantity' => 'required|numeric|min:0.000000001',
            'date' => 'required|date|after:yesterday'
        ];
    }
}
