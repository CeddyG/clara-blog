<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\PageCategoryRepository;

class PageCategoryController extends ContentManagerController
{
    public function __construct(PageCategoryRepository $oRepository)
    {
        $this->sPath            = 'admin/page-category';
        $this->sPathRedirect    = 'admin/page-category';
        $this->sName            = __('page-category.page_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\PageCategoryRequest';
    }
}
