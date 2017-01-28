<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Author extends Model
{

    public function quotes()
    {
    	return $this->hasMany('App\Quote');
    }

    // protected $table = 'authors';
    // protected $fillable = ['name'];
}
