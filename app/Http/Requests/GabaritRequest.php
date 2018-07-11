<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GabaritRequest extends FormRequest
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
            'id_gabarit' => 'numeric',	    'type_gabarit' => 'string|max:20',	    'created_at' => 'string',	    'updated_at' => 'string'
        ];
    }
}

