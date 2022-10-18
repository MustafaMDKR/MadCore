<?php
declare(strict_types=1);
namespace Mad\LiquidOrm\DataMapper;

use Mad\Base\Exception\BaseUnexpectedValueException;
use Mad\DatabaseConnection\DatabaseConnectionInterface;
use Mad\LiquidOrm\DataMapper\Exception\DataMapperException;
use Mad\Yaml\YamlConfig;

class DataMapperFactory
{

  /**
   * Main constructor class
   * 
   * @return void
   */
  public function __construct()
  {}

  /**
   * 
   *
   * @param string $dbConStr
   * @param string $dataMapperEnvConfig
   * @return DataMapperInterface
   * @throws BaseUnexpectedValueException
   */
  public function create(string $dbConStr, string $dataMapperEnvConfig): DataMapperInterface
  {
    $credentials = (new $dataMapperEnvConfig([]))->getDBCredentials(YamlConfig::file('app')['pdo_driver']);
    $dbConObj = new $dbConStr($credentials);
    if (!$dbConObj instanceof DatabaseConnectionInterface) {
      throw new BaseUnexpectedValueException($dbConStr . ' is not a valid database connection object.');
    }
    return new DataMapper($dbConObj);
  }
} 