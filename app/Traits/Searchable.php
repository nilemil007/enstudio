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

        foreach( $this->searchable as $column )
        {
            if ( str_contains($column, '.' ))
            {
                $relation = Str::beforeLast( $column, '.' );
                $column = Str::afterLast( $column, '.' );

                $builder->orWhereRelation($relation, $column, 'LIKE', "%$term%");
                continue;
            }

            $builder->orWhere( $column, 'LIKE', "%$term%");
        }

        return $builder;
    }
}