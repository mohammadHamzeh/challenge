<?php

namespace App\Filter\Contracts;

/*
 * trait for add to model are filterable
 * */
trait Filterable
{
    public function scopeFilters($query, QueryFilter $queryFilter)
    {
        return $queryFilter->apply($query);
    }

}
