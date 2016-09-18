<?php

namespace App;

use App\Scopes\NotApprovedScope;
use Illuminate\Database\Eloquent\Model;
use App\Quote;

class SubmissionNotApproved extends Quote
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new ApprovedScope);
        static::addGlobalScope(new NotApprovedScope);
    }

    protected $table = 'quotes';
}
