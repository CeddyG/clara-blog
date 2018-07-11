<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PageCategory extends Model
{
    protected $table = 'page_category';
    protected $primaryKey = 'id_page_category';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_page_category'
    ];
    

    public function page()
    {
        return $this->hasMany('App\Models\Page', 'fk_page_category');
    }


}

