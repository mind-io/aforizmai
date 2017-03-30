<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new QuoteScope);
    //     static::addGlobalScope(new SubmissionScope);
    // }


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


    // define local scopes to filter quotes and submissions
    
    public function scopeApproved($query)
    {
        $query->where('approved', true);
    }

    public function scopeNotApproved($query)
    {
        $query->where('approved', false);
    }


}
