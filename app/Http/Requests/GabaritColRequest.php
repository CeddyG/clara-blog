<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GabaritColRequest extends FormRequest
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
            'id_gabarit_col' => 'numeric',	    'fk_col' => 'numeric',	    'fk_gabarit' => 'numeric',	    'content_gabarit_col' => '',	    'created_at' => 'string',	    'updated_at' => 'string'
        ];
    }
}

