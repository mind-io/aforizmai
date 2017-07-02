<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use DB;

class Author extends Model
{

    public function quotes()
    {
    	return $this->hasMany('App\Quote');
    }

    public function approvedQuotes()
    {
        return $this->quotes()->approved();
    }    

    public function notApprovedQuotes()
    {
        return $this->quotes()->notApproved();
    }      

    public function likes()
    {
        return $this->hasManyThrough('App\Like', 'App\Quote');
    }

    // local scope for Authors with liked quotes ant total count of all likes
    public function scopePopular($query)
    {
        $query->has('likes')->withCount('likes')->get();
    }

    // protected $table = 'authors';
    // protected $fillable = ['name'];
}
