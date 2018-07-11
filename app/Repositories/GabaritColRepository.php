<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class GabaritColRepository extends QueryBuilderRepository
{
    protected $sTable = 'gabarit_col';

    protected $sPrimaryKey = 'id_gabarit_col';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    /**
     * Indicates if the query should be timestamped.
     *
     * @var bool
     */
    protected $bTimestamp = true;
    
    protected $aRelations = [
        'col',
		'gabarit'
    ];

    protected $aFillable = [
        'fk_col',
		'fk_gabarit',
		'content_gabarit_col'
    ];
    
   
    public function col()
    {
        return $this->belongsTo('App\Repositories\ColRepository', 'fk_col');
    }

    public function gabarit()
    {
        return $this->belongsTo('App\Repositories\GabaritRepository', 'fk_gabarit');
    }


}
