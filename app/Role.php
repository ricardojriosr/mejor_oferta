<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable
{
    protected $table = 'roles';
    protected $fillable = ['name','description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
