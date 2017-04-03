<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    protected $fillable = ['category_id','name','display_name','description'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
