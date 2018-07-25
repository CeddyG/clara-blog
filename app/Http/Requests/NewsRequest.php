<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Sentinel;

class NewsRequest extends FormRequest
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
            'id_news' => 'numeric',
            'fk_news_category' => 'numeric',
            'fk_users' => 'numeric',
            'title_news' => 'string|max:90',
            'url_news' => 'string|max:255',
            'text_news' => '',
            'url_image_news' => 'string|max:255|nullable',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

