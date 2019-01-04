<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offerimage extends Model
{
    //Offers Images
    protected $table = 'offer_image';
    protected $fillable = ['offer_id','url_image'];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}
