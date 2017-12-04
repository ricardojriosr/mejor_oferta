<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //Offers in octicon-database
    protected $table = 'offer';
    protected $fillable = ['price','condition_id','user_id','observations'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function condition()
    {
        return $this->belongsTo('App\Condition');
    }
}
