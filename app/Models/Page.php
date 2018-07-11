<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'id_page';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_page_category',
		'fk_users',
		'url_page',
		'name_page'
    ];
    

    public function page_category()
    {
        return $this->belongsTo('App\Models\PageCategory', 'fk_page_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'fk_users');
    }

    public function row()
    {
        return $this->hasMany('App\Models\Row', 'fk_page');
    }


}

