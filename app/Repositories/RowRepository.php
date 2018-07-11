<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class RowRepository extends QueryBuilderRepository
{
    protected $sTable = 'row';

    protected $sPrimaryKey = 'id_row';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    /**
     * Indicates if the query should be timestamped.
     *
     * @var bool
     */
    protected $bTimestamp = true;
    
    protected $aRelations = [
        'page',
		'col',
		'cols'
    ];

    protected $aFillable = [
        'fk_page',
		'fk_col',
		'pos_row',
		'class_row',
		'style_row',
		'attribute_row'
    ];
    
   
    public function page()
    {
        return $this->belongsTo('App\Repositories\PageRepository', 'fk_page');
    }

    public function col()
    {
        return $this->belongsTo('App\Repositories\ColRepository', 'fk_col');
    }

    public function cols()
    {
        return $this->hasMany('App\Repositories\ColRepository', 'fk_row');
    }


}
