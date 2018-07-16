<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id_news';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_news_category',
		'fk_users',
		'title_news',
		'url_news',
		'text_news',
		'url_image_news'
    ];
    

    public function news_category()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'fk_news_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'fk_users');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'news_tag', 'fk_news', 'fk_tag');
    }


}

