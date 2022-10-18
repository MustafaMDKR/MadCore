<?php

declare (strict_types=1);

namespace Mad\Base;

use Mad\Base\Exception\BaseInvalidArgException;
use Mad\LiquidOrm\DataRepository\DataRepository;
use Mad\LiquidOrm\DataRepository\DataRepositoryFactory;

class BaseModel
{

    /**
     * @var string
     */
    private string $tableSchema;

    /**
     * @var string
     */
    private string $tableSchemaID;

    /**
     * @var Object
     */
    private Object $repository;

    /**
     * Main Class Constructor
     *
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @return void
     * @throws BaseInvalidArgException
     */
    public function __construct(string $tableSchema, string $tableSchemaID)
    {
        if (empty($tableSchema) || empty($tableSchemaID)) {
            throw new BaseInvalidArgException('These arguments are required.');
        }
        $factory = new DataRepositoryFactory('basicCrud', $tableSchema, $tableSchemaID);
        $this->repository = $factory->create(DataRepository::class);
    }

    /**
     * Get the data repository object based on the context model
     * which the repository is being executed from.
     *
     * @return DataRepository
     */
    public function getRepo(): DataRepository
    {
        return $this->repository;
    }

}