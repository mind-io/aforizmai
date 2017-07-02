<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function quote() 
    {
    	return $this->belongsTo('App\Quote');
    }

    // local scope for users likes
    public function scopeUserLikes($query)
    {
        $userID = Auth::user()->id;
        $query->where('user_id', $userID);
    }

    

}
