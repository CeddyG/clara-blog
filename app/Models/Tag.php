<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'id_tag';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_tag'
    ];
    

    public function news()
    {
        return $this->belongsToMany('App\Models\News', 'news_tag', 'fk_tag', 'fk_news');
    }


}

