<?php

declare (strict_types=1);

namespace Mad\LiquidOrm\EntityManager;

use Mad\LiquidOrm\DataMapper\DataMapperInterface;
use Mad\LiquidOrm\EntityManager\Exception\CrudException;
use Mad\LiquidOrm\QueryBuilder\QueryBuilderInterface;

class EntityManagerFactory
{

    protected DataMapperInterface $dataMapper;

    protected QueryBuilderInterface $queryBuilder;


    /**
     * Main constructor class
     *
     * @param DataMapperInterface   $dataMapper
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }


    public function create(string $crudString, string $tableSchema, string $tableSchemaID, array $options = []): EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID);
        if (!$crudObject instanceof CrudInterface) {
            throw new CrudException($crudString . ' is not a valid CRUD object');
        }
        return new EntityManager($crudObject);
    }
}