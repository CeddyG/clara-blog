<?php

namespace App\Http\Controllers;

use Facades\App\Repositories\PageRepository;

class PageController extends Controller
{
    public function show($sSlug)
    {
        $oPage = PageRepository::getFillFromView('abricot/page/show')
            ->findByField('url_page', $sSlug)
            ->first();
        
        if ($oPage !== null)
        {
            $sTitlePage = $oPage->title_page;

            return view('abricot/page/show', compact('oPage', 'sTitlePage'));
        }
        else
        {
            abort(404);
        }
    }
}
