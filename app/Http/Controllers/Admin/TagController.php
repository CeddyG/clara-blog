<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\TagRepository;

class TagController extends ContentManagerController
{
    public function __construct(TagRepository $oRepository)
    {
        $this->sPath            = 'admin/tag';
        $this->sPathRedirect    = 'admin/tag';
        $this->sName            = __('tag.tag');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\TagRequest';
    }
}
