<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArticle extends Model
{
    protected $table = 'article_images';
    protected $fillable = ['article_id','url_image'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
