<?php 

namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ApprovedScope;

class NotApprovedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Illuminate\Database\EloquentBuilder  $builder
     * @param  Illuminate\Database\EloquentModel  $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('approved', false);
    }
}