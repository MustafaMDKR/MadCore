<?php

declare (strict_types=1);

namespace Mad\LiquidOrm;

use Mad\DatabaseConnection\DatabaseConnection;
use Mad\LiquidOrm\DataMapper\DataMapperEnvConfig;
use Mad\LiquidOrm\DataMapper\DataMapperFactory;
use Mad\LiquidOrm\EntityManager\Crud;
use Mad\LiquidOrm\EntityManager\EntityManagerFactory;
use Mad\LiquidOrm\QueryBuilder\QueryBuilder;
use Mad\LiquidOrm\QueryBuilder\QueryBuilderFactory;

class LiquidOrmManager
{

    protected string $tableSchema;

    protected string $tableSchemaID;

    protected array $options;

    protected DataMapperEnvConfig $envireonmentConfiguration;

    public function __construct(DataMapperEnvConfig $envireonmentConfiguration, string $tableSchema, string $tableSchemaID, ?array $options = []) {
        $this->envireonmentConfiguration = $envireonmentConfiguration;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
        $this->options = $options;
    }

    public function intialize()
    {
        $dataMapperFactory = new DataMapperFactory();
        $dataMapper = $dataMapperFactory->create(DatabaseConnection::class, DataMapperEnvConfig::class);
        
        if ($dataMapper) {
            $queryBuilderFactory = new QueryBuilderFactory();
            $queryBuilder = $queryBuilderFactory->create(QueryBuilder::class);
            if ($queryBuilder) {
                $entityManagerFactory = new EntityManagerFactory($dataMapper, $queryBuilder);
                return $entityManagerFactory->create(Crud::class, $this->tableSchema, $this->tableSchemaID, $this->options);
            }
        }
    }
}
