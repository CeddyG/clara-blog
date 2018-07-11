<?php

namespace App\Providers;

use View;
use Route;
use Sentinel;
use Navigation;

use Illuminate\Support\ServiceProvider;

class AdminNavbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.sidebar', function($view)
        {
            $sRoute     = Route::getCurrentRoute()->getName();
            $aAction    = explode('.', $sRoute);
            $sEntity    = isset($aAction[1]) ? $aAction[1] : '';
            
            $aConfigNavbar = config('clara.navbar');
            
            $aNavbar = [
                [
                    'News',
                    [
                        ['title' => 'Liste', 'link' => route('admin.news.index'), 'active' => $sEntity == 'news'],
                        ['title' => 'Catégorie', 'link' => route('admin.news-category.index'), 'active' => $sEntity == 'news-category']
                    ]
                ],
                [
                    'Pages',
                    [
                        ['title' => 'Liste', 'link' => route('admin.page.index'), 'active' => $sEntity == 'page'],
                        ['title' => 'Catégorie', 'link' => route('admin.page-category.index'), 'active' => $sEntity == 'page-category']
                    ]
                ],
            ];
            
            foreach ($aConfigNavbar as $sKey => $sTitle)
            {
                if (Sentinel::hasAccess('admin.'.$sKey.'.index') && Route::has('admin.'.$sKey.'.index'))
                {
                    $aNavbar[] = ['title' => $sTitle, 'link' => route('admin.'.$sKey.'.index'), 'active' => $sEntity == $sKey];
                }
            }
            
            $aNavbarParam = [
                [
                    'Users',
                    [
                        ['title' => 'Liste', 'link' => URL('admin/user'), 'active' => $sEntity == 'user'],
                        ['title' => 'Groupes', 'link' => URL('admin/group'), 'active' => $sEntity == 'group']
                    ]
                ],
                ['title' => 'Langue', 'link' => URL('admin/lang'), 'active' => $sEntity == 'lang'],
                ['title' => 'Dataflow', 'link' => URL('admin/dataflow'), 'active' => $sEntity == 'dataflow'],
                ['title' => 'Entity', 'link' => URL('admin/clara-entity'), 'active' => $sEntity == 'clara-entity']
            ];
            
            $sNavbar        = Navigation::pills($aNavbar, ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'])->stacked();
            $sNavbarParam   = Navigation::pills($aNavbarParam, ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'])->stacked();
            
            $view->with('navbar', $sNavbar);
            $view->with('navbarparam', $sNavbarParam);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}