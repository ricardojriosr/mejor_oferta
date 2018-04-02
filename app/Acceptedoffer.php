<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceptedoffer extends Model
{
    protected $table = 'accepted_offers';
    protected $fillable = ['article_id','offer_id'];

    public function offers()
    {
        return $this->belongsTo('App\Offer');
    }

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
