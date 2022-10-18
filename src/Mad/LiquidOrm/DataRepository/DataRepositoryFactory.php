<?php

declare (strict_types=1);

namespace Mad\LiquidOrm\DataRepository;

use Mad\Base\Exception\BaseUnexpectedValueException;
use Mad\LiquidOrm\DataMapper\DataMapperEnvConfig;
use Mad\LiquidOrm\LiquidOrmManager;
use Mad\Yaml\YamlConfig;

class DataRepositoryFactory
{

    /**
     * @var string
     */
    protected string $tableSchema;

    /**
     * @var string
     */
    protected string $tableSchemaID;

    /**
     * @var string
     */
    protected string $crudIdentifier;


    /**
     * Main class constructor
     *
     * @param string $crudIdentifier
     * @param string $tableSchema
     * @param string $tableSchemaID
     */
    public function __construct(string $crudIdentifier, string $tableSchema, string $tableSchemaID)
    {
        $this->crudIdentifier = $crudIdentifier;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }


    /**
     * A method to create the Data Repository Object
     *
     * @param string $dataRepositoryString
     * @return void
     */
    public function create(string $dataRepositoryString)
    {
        $entityManager = $this->intializeLiquidOrmManager();
        $dataRepositoryObject = new $dataRepositoryString($entityManager);
        if (!$dataRepositoryObject instanceof DataRepositoryInterface) {
            throw new BaseUnexpectedValueException($dataRepositoryString . ' is not a valid repository object');
        }
        return $dataRepositoryObject;
    }



    public function intializeLiquidOrmManager()
    {
        $envConfiguration = new DataMapperEnvConfig(YamlConfig::file('database'));
        $ormManager = new LiquidOrmManager($envConfiguration, $this->tableSchema, $this->tableSchemaID);
        return $ormManager->intialize();
    }
    
}
