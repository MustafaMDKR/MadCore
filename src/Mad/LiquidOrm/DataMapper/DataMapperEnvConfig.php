<?php
declare(strict_types=1);
namespace Mad\LiquidOrm\DataMapper;

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
    foreach ($this->credentials as $credential) {
      if (array_key_exists($driver, $credential)) {
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
    if (empty($driver) && !is_string($driver)) {
      throw new DataMapperInvalidArgumentException('Invalid argument. This is either missing or off the invalid data type.');
    }
    if (!is_array($this->credentials)) {
      throw new DataMapperInvalidArgumentException('Invalid credentials');
    }
    if (!in_array($driver, array_keys($this->credentials[$driver]))) {
      throw new DataMapperInvalidArgumentException('Invalid or unsupported database driver.');
    }
  }
}