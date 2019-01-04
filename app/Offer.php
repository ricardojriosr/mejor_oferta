<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Searchable;

class Offer extends Model {
    //Offers in octicon-database
    protected $table = 'offer';
    protected $fillable = ['price','condition_id','user_id','article_id','observations','warranty'];

    public function article() {
        return $this->belongsTo('App\Article');
    }

    public function condition() {
        return $this->belongsTo('App\Condition');
    }

    public function scopeSearch($query, $name) {
        return DB::select(DB::raw("SELECT * FROM offer A INNER JOIN article B ON A.article_id = B.id WHERE B.name LIKE '%:name%'"),['name',$name]);
    }

    public function acceptedoffer()
    {
        return $this->hasMany('App\Acceptedoffer');
    }

    public function offerimage()
    {
        return $this->hasMany('App\Offerimage');
    }
}
