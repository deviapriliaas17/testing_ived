<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    public function blog()
    {
        return $this->hasMany('App\blog');
    }
}

