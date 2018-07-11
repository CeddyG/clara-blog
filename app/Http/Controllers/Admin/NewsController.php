<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\NewsRepository;

class NewsController extends ContentManagerController
{
    public function __construct(NewsRepository $oRepository)
    {
        $this->sPath            = 'admin/news';
        $this->sPathRedirect    = 'admin/news';
        $this->sName            = __('news.news');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\NewsRequest';
    }
}
