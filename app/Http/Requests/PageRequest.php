<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
    
    public function all($keys = null)
    {
        $aAttribute = parent::all($keys);
        
        if (Sentinel::check())
        {
            $aAttribute['fk_users'] = Sentinel::getUser()->id;
        }
        
        return $aAttribute;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_page' => 'numeric',
            'fk_page_category' => 'numeric',
            'fk_users' => 'numeric',
            'title_page' => 'string|max:45',
            'url_page' => 'string|max:255',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

