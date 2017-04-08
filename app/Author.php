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

    // protected $table = 'authors';
    // protected $fillable = ['name'];
}
