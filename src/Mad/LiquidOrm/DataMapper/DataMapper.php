<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\DataMapper;

use Mad\DatabaseConnection\DatabaseConnectionInterface;
use Mad\LiquidOrm\DataMapper\Exception\DataMapperException;
use PDO;
use PDOStatement;
use Throwable;

class DataMapper implements DataMapperInterface
{

  /**
   * @var DatabaseConnectionInterface
   */
  private DatabaseConnectionInterface $dbh;


  /**
   * @var PDOStatement
   */
  private PDOStatement $statement;


  /**
   * Main constructor class
   *
   * @param DatabaseConnectionInterface $dbh
   * @return void
   */
  public function __construct(DatabaseConnectionInterface $dbh)
  {
    $this->dbh = $dbh;
  }


  /**
   * Check if the incoming value is not empty else throw an exception
   *
   * @param mixed $value
   * @param string|null $errorMessage
   * @return void
   * @throws DataMapperException
   */
  private function isEmpty(mixed $value, string $errorMessage = null)
  {

    if (empty($value)) {
      throw new DataMapperException($errorMessage);
    }
  }


  /**
   * Check if the incoming argument $value is an array else throw 
   * an exception.
   *
   * @param array $value
   * @return void
   * @throws DataMapperException
   */
  private function isArray(array $value)
  {
    if (!is_array($value)) {
      throw new DataMapperException('Your argument needs to be an array');
    }
  }


  /**
   * @inheritDoc
   *
   * @param string $sqlQuery
   * @return self
   */
  public function prepare(string $sqlQuery): self
  {
    $this->statement = $this->dbh->open()->prepare($sqlQuery);
    return $this;
  }


  /**
   * @inheritDoc
   */
  public function bind(mixed $value)
  {
    try {
      switch ($value) {
        case is_bool($value):
        case intval($value):
          $dataType = PDO::PARAM_INT;
          break;
        case is_null($value):
          $dataType = PDO::PARAM_NULL;
          break;
        
        default:
          $dataType = PDO::PARAM_STR;
          break;
      }
      return $dataType;
    } catch (DataMapperException $exception) {
      throw $exception;
    }
  }


  public function bindParameters(array $fields, bool $isSearch = false): self
  {
    if (is_array($fields)){
      $type = ($isSearch === false) ? $this->bindValues($fields) : $this->bind($fields);
      if ($type) {
        return $this;
      }
    }
    return false;
  }


  /**
   * Binds a value to a corresponding name or ? placeholder in 
   * the SQL statement that was used to prepare the statement
   *
   * @param array $fields
   * @return PDOStatement
   * @throws DataMapperException
   */
  protected function bindValues(array $fields): PDOStatement
  {
    $this->isArray($fields);
    foreach ($fields as $key => $value) {
      $this->statement->bindValue(':' . $key, $value, $this->bind($value));
    }
    return $this->statement;
  }


  /**
   * Binds a value to a corresponding name or ? placeholder in 
   * the SQL statement that was used to prepare the statement but optimized
   * for search queries.
   *
   * @param array $fields
   * @return PDOStatement
   * @throws DataMapperException
   */
  protected function bindSearchValues(array $fields): PDOStatement
  {
    $this->isArray($fields);
    foreach ($fields as $key => $value) {
      $this->statement->bindValue(':' . $key, '%' . $value . '%', $this->bind($value));
    }
    return $this->statement;
  }


  /**
   * @inheritDoc
   *
   * @return void
   */
  public function execute(): void
  {
    if ($this->statement) {
      return $this->statement->execute();
    }
  }


  /**
   * @inheritDoc
   *
   * @return integer
   */
  public function numRows(): int
  {
    if ($this->statement) {
      return $this->statement->rowCount();
    }
  }


  /**
   * @inheritDoc
   *
   * @return Object
   */
  public function result(): Object
  {
    if ($this->statement) {
      return $this->statement->fetch(PDO::FETCH_OBJ);
    }
  }


  /**
   * @inheritDoc
   *
   * @return array
   */
  public function results(): array
  {
    if ($this->statement) {
      return $this->statement->fetchAll();
    }
  }


  /**
   * @inheritDoc
   * @return integer
   * @throws Throwable
   */
  public function getLastId(): int
  {
    try {
      if ($this->dbh->open()) {
        $lastId = $this->dbh->open()->lastInsertId();
        if (!empty($lastId)) {
          return intval($lastId);
        }
      }
    } catch (Throwable $throwable) {
      throw $throwable;
    }
  }

}