<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class blog extends Model
{
    protected $fillable = [
        'title','content','category_id','image','slug'
    ];
    
    protected $hidden = ['id'];
    protected $appends = ['key'];

    public function category()
    {
        return $this->belongsTo('App\category');
    }
    public function getKeyAttribute(){
        $key = encrypt($this->id);
        return $key;
    }
}
