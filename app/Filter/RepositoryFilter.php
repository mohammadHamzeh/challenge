<?php

namespace App\Filter;


use App\Filter\Contracts\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class RepositoryFilter extends QueryFilter
{
    public function tags($value)
    {
        return $this->builder->whereHas('tags', function (Builder $query) use ($value) {
            $query->where('slug', 'like', $value);
        })->get();
    }
}
