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
            'quantity' => 'required|numeric',
            'date' => 'required|date'
        ];
    }
}
