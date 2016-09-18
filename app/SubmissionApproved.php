<?php

namespace App;

use App\Scopes\ApprovedScope;
use Illuminate\Database\Eloquent\Model;
use App\Quote;

class SubmissionApproved extends Quote
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ApprovedScope);
        // static::addGlobalScope(new NotApprovedScope);
    }

    protected $table = 'quotes';
}
