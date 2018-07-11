<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_news' => 'numeric',	    'fk_news_category' => 'numeric',	    'fk_users' => 'numeric',	    'title_new' => 'string|max:90',	    'text_news' => '',	    'url_image_news' => 'string|max:255',	    'created_at' => 'string',	    'updated_at' => 'string'
        ];
    }
}

