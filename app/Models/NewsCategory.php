<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class NewsCategory extends Model
{
    protected $table = 'news_category';
    protected $primaryKey = 'id_news_category';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_news_category'
    ];
    

    public function news()
    {
        return $this->hasMany('App\Models\News', 'fk_news_category');
    }


}

