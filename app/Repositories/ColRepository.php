<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class ColRepository extends QueryBuilderRepository
{
    protected $sTable = 'col';

    protected $sPrimaryKey = 'id_col';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    /**
     * Indicates if the query should be timestamped.
     *
     * @var bool
     */
    protected $bTimestamp = true;
    
    protected $aRelations = [
		'gabarit_col',
        'row',
		'rows'
    ];

    protected $aFillable = [
        'fk_row',
		'pos_col',
		'class_col',
		'style_col',
		'attribute_col',
		'size_xs',
		'size_s',
		'size_m',
		'size_l',
		'size_offset_xs',
		'size_offset_s',
		'size_offset_m',
		'size_offset_l'
    ];    

    public function gabarit_col()
    {
        return $this->hasMany('App\Repositories\GabaritColRepository', 'fk_col');
    }
   
    public function row()
    {
        return $this->belongsTo('App\Repositories\RowRepository', 'fk_row');
    }

    public function rows()
    {
        return $this->hasMany('App\Repositories\RowRepository', 'fk_col');
    }
}
