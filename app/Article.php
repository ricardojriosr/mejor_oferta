<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = ['category_id','subcategory_id','name','display_name','description','quantity'];
}
