<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Col extends Model
{
    protected $table = 'col';
    protected $primaryKey = 'id_col';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
    

    public function row()
    {
        return $this->belongsTo('App\Models\Row', 'fk_row');
    }

    public function gabarit_col()
    {
        return $this->hasMany('App\Models\GabaritCol', 'fk_col');
    }

    public function row()
    {
        return $this->hasMany('App\Models\Row', 'fk_col');
    }


}

