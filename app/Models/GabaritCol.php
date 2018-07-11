<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class GabaritCol extends Model
{
    protected $table = 'gabarit_col';
    protected $primaryKey = 'id_gabarit_col';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_col',
		'fk_gabarit',
		'content_gabarit_col'
    ];
    

    public function col()
    {
        return $this->belongsTo('App\Models\Col', 'fk_col');
    }

    public function gabarit()
    {
        return $this->belongsTo('App\Models\Gabarit', 'fk_gabarit');
    }


}

