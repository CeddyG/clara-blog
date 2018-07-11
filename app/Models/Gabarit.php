<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Gabarit extends Model
{
    protected $table = 'gabarit';
    protected $primaryKey = 'id_gabarit';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_gabarit'
    ];
    

    public function gabarit_col()
    {
        return $this->hasMany('App\Models\GabaritCol', 'fk_gabarit');
    }


}

