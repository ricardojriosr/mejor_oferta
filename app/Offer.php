<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Searchable;

class Offer extends Model
{
    //Offers in octicon-database
    protected $table = 'offer';
    protected $fillable = ['price','condition_id','user_id','article_id','observations','warranty'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function condition()
    {
        return $this->belongsTo('App\Condition');
    }

    public function scopeSearch($query, $name) {
        return $query->where('name','LIKE','%name%');
    }
}
