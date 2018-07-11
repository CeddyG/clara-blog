<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Row extends Model
{
    protected $table = 'row';
    protected $primaryKey = 'id_row';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_page',
		'fk_col',
		'pos_row',
		'class_row',
		'style_row',
		'attribute_row'
    ];
    

    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'fk_page');
    }

    public function col()
    {
        return $this->belongsTo('App\Models\Col', 'fk_col');
    }

    public function col()
    {
        return $this->hasMany('App\Models\Col', 'fk_row');
    }


}

