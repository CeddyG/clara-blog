<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\PageRepository;

class PageController extends ContentManagerController
{
    public function __construct(PageRepository $oRepository)
    {
        $this->sPath            = 'admin/page';
        $this->sPathRedirect    = 'admin/page';
        $this->sName            = __('page.page');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\PageRequest';
    }
}
