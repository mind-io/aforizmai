<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
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

}
