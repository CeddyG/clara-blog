<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class GabaritRepository extends QueryBuilderRepository
{
    protected $sTable = 'gabarit';

    protected $sPrimaryKey = 'id_gabarit';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    /**
     * Indicates if the query should be timestamped.
     *
     * @var bool
     */
    protected $bTimestamp = true;
    
    protected $aRelations = [
        'gabarit_col'
    ];

    protected $aFillable = [
        'type_gabarit'
    ];
    
   
    public function gabarit_col()
    {
        return $this->hasMany('App\Repositories\GabaritColRepository', 'fk_gabarit');
    }


}
