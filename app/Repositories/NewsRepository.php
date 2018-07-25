<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class NewsRepository extends QueryBuilderRepository
{
    protected $sTable = 'news';

    protected $sPrimaryKey = 'id_news';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news_category',
		'users',
		'tag'
    ];

    protected $aFillable = [
        'fk_news_category',
		'fk_users',
		'title_news',
		'url_news',
		'text_news',
		'url_image_news'
    ];
    
   
    public function news_category()
    {
        return $this->belongsTo('App\Repositories\NewsCategoryRepository', 'fk_news_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Repositories\UsersRepository', 'fk_users');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Repositories\TagRepository', 'news_tag', 'fk_news', 'fk_tag');
    }


}
