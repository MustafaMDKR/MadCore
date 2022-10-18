<?php
declare(strict_types=1);
namespace Mad\LiquidOrm\DataMapper;

use Mad\Base\Exception\BaseInvalidArgException;
use Mad\LiquidOrm\DataMapper\Exception\DataMapperInvalidArgumentException;

class DataMapperEnvConfig
{

  /**
   * @var array
   */
  private array $credentials;

  /**
   * Main constructor class
   *
   * @param array $credentials
   * @return void
   */
  public function __construct(array $credentials)
  {
    $this->credentials = $credentials;
  }

  /**
   * Get the user defined database connection array.
   *
   * @param string $driver
   * @return array
   */
  public function getDBCredentials(string $driver): array
  {
    $connectionArray = [];
    $this->isCredentialsValid($driver);
    foreach ($this->credentials as $credential) {
      if (!array_key_exists($driver, $credential)) {
        throw new BaseInvalidArgException('Your selected Database driver is not supported. Please see the database.yaml file for all support driver. Or specify a supported driver from your app.yaml configuration file');
      } else {
        $connectionArray = $credential[$driver];
      }
    }
    return $connectionArray;
  }


  /**
   * Checks the validity of DB credentials.
   *
   * @param string $driver
   * @return void
   */
  private function isCredentialsValid(string $driver): void
  {
    if (empty($driver) || !is_array($this->credentials)) {
      throw new BaseInvalidArgException('You have either not specify the default database driver or the database.yaml is returning null or empty.');
    }
    
  }
}