<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArticle extends Model
{
    protected $table = 'article_images';
    protected $fillable = ['article_id','url_image','default','name'];
    protected $primaryKey = 'article_images_id'; //Like this???

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
