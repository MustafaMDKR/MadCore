<?php

declare (strict_types=1);

namespace Mad\LiquidOrm\EntityManager;

use Mad\Base\Exception\BaseUnexpectedValueException;
use Mad\LiquidOrm\DataMapper\DataMapperInterface;
use Mad\LiquidOrm\QueryBuilder\QueryBuilderInterface;

class EntityManagerFactory
{

    /**
     * @var DataMapperInterface
     */
    protected DataMapperInterface $dataMapper;

    /**
     * @var QueryBuilderInterface
     */
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


    /**
     * A method to create the entity manager object and inject the 
     * dependency which is in the crud object
     *
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @param array  $options
     * @return EntityManagerInterface
     */
    public function create(string $crudString, string $tableSchema, string $tableSchemaID, array $options = []): EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID, $options);
        if (!$crudObject instanceof CrudInterface) {
            throw new BaseUnexpectedValueException($crudString . ' is not a valid CRUD object');
        }
        return new EntityManager($crudObject);
    }
}