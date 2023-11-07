<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Exception;

trait Searchable
{
    /**
     * Dynamic Search.
     *
     * @param Builder $builder
     * @param string|null $term
     * @return Builder
     * @throws Exception
     */
    public function scopeSearch( Builder $builder, string $term = null ): Builder
    {
        if ( !$this->searchable )
        {
            throw new Exception("Please define the searchable property.");
        }

        foreach( $this->searchable as $searchable )
        {
            if ( str_contains($searchable, '.' ))
            {
                $relation = Str::beforeLast( $searchable, '.' );
                $column = Str::afterLast( $searchable, '.' );
                $builder->orWhereRelation($relation, $column, 'LIKE', "%$term%");
                continue;
            }

            $builder->orWhere( $searchable, 'LIKE', "%$term%");
        }

        return $builder;
    }
}