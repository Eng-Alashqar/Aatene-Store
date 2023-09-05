<?php

namespace App\Models\Scopes;

use App\Models\Users\Seller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class StoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = request()->user();
        if ($user instanceof Seller) $builder->where('store_id', $user->store_id);
    }
}
