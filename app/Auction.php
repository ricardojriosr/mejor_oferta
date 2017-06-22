<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auction';
    protected $fillable = ['article_id','user_id','description','price','warranty'];
}
