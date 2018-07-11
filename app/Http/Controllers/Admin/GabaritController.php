<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use App\Repositories\GabaritRepository;

class GabaritController extends ContentManagerController
{
    public function __construct(GabaritRepository $oRepository)
    {
        $this->sPath            = 'admin/gabarit';
        $this->sPathRedirect    = 'admin/gabarit';
        $this->sName            = __('gabarit.gabarit');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'App\Http\Requests\GabaritRequest';
    }
}
