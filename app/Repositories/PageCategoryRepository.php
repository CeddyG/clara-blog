<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class PageCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'page_category';

    protected $sPrimaryKey = 'id_page_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'page'
    ];

    protected $aFillable = [
        'name_page_category'
    ];
    
   
    public function page()
    {
        return $this->hasMany('App\Repositories\PageRepository', 'fk_page_category');
    }


}
