<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RowRequest extends FormRequest
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
            'id_row' => 'numeric',	    'fk_page' => 'numeric',	    'fk_col' => 'numeric',	    'pos_row' => 'numeric',	    'class_row' => 'string|max:255',	    'style_row' => 'string|max:255',	    'attribute_row' => 'string|max:255',	    'created_at' => 'string',	    'updated_at' => 'string'
        ];
    }
}

