<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\QueryBuilder;

use Mad\LiquidOrm\QueryBuilder\Exception\QueryBuilderException;

class QueryBuilderFactory
{
    /**
     * Main constructor method.
     */
    public function __construct()
    {
    }

    public function create(string $queryBuilderString): QueryBuilderInterface
    {
        $queryBuilderObj = new $queryBuilderString();
        if (!$queryBuilderString instanceof QueryBuilderInterface) {
            throw new QueryBuilderException($queryBuilderString.'is not a valid query builder object.');
        }

        return new QueryBuilder();
    }
}
