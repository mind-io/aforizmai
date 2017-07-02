<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quote extends Model
{
    
    public function author()
    {
    	return $this->belongsTo('App\Author');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function userFavoriteQuotes()
    {
        return $this->likes()->userLikes();
    }       

    // local scope for popular (liked) quotes
    public function scopePopular($query)
    {
         $query->has('likes')->withCount('likes')->get();
    }

    // local scopes to filter approved quotes
    public function scopeApproved($query)
    {
        $query->where('approved', true);
    }

    // local scopes to filter submissions
    public function scopeNotApproved($query)
    {
        $query->where('approved', false);
    }

}
