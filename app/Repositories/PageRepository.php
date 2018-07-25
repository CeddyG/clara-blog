<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class PageRepository extends QueryBuilderRepository
{
    protected $sTable = 'page';

    protected $sPrimaryKey = 'id_page';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page_category',
		'users',
		'row'
    ];

    protected $aFillable = [
        'fk_page_category',
		'fk_users',
		'title_page',
		'url_page'
    ];
    
   
    public function page_category()
    {
        return $this->belongsTo('App\Repositories\PageCategoryRepository', 'fk_page_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Repositories\UsersRepository', 'fk_users');
    }

    public function row()
    {
        return $this->hasMany('App\Repositories\RowRepository', 'fk_page');
    }


}
