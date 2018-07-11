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
		'users'
    ];

    protected $aFillable = [
        'fk_news_category',
		'fk_users',
		'title_new',
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


}
