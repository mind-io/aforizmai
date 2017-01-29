<?php

namespace App;

// use App\Scopes\ApprovedScope;
// use App\Scopes\NotApprovedScope;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new ApprovedScope);
    //     // static::addGlobalScope(new NotApprovedScope);
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

    // define local scopes to filter quotes and submissions
    
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeNotApproved($query)
    {
        return $query->where('approved', false);
    }


}
