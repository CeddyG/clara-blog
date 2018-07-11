<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\NewsCategoryRepository;

class NewsCategoryController extends ContentManagerController
{
    public function __construct(NewsCategoryRepository $oRepository)
    {
        $this->sPath            = 'admin/news-category';
        $this->sPathRedirect    = 'admin/news-category';
        $this->sName            = __('news-category.news_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\NewsCategoryRequest';
    }
}
