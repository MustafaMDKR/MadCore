<?php
declare(strict_types=1);
namespace Mad\LiquidOrm\DataMapper;

use Mad\DatabaseConnection\DatabaseConnectionInterface;
use Mad\LiquidOrm\DataMapper\Exception\DataMapperException;

class DataMapperFactory
{

  /**
   * Main constructor class
   * 
   * @return void
   */
  public function __construct()
  {}

  public function create(string $dbConStr, string $dataMapperEnvConfig): DataMapperInterface
  {
    $credentials = (new $dataMapperEnvConfig([]))->getDBCredentials('mysql');
    $dbConObj = new $dbConStr($credentials);
    if (!$dbConObj instanceof DatabaseConnectionInterface) {
      throw new DataMapperException($dbConStr . ' is not a valid database connection interface.');
    }
    return new DataMapper($dbConObj);
  }
}