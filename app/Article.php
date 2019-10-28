<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = ['category_id','subcategory_id','name','display_name','description','quantity','budget','highlight'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function images()
    {
        return $this->hasMany('App\ImageArticle');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}
