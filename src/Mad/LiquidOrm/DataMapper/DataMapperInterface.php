<?php
declare(strict_types=1);

namespace Mad\LiquidOrm\DataMapper;

interface DataMapperInterface
{

  /**
   * Prepare the query string and returns self to be easily chainable 
   * by returning self object
   *
   * @param string $sqlQuery
   * @return self
   */
  public function prepare(string $sqlQuery): self;

  /**
   * Set our data type for the paarameters using the PDO::PARAM constants
   *
   * @param mixed $value
   * @return mixed
   */
  public function bind(mixed $value): mixed;


  /**
   * A method which combines the 2 methods above. One is optimized for binding 
   * search queries once the second arg is set to search. 
   *
   * @param array   $fields
   * @param boolean $isSearch
   * @return self
   */
  public function bindParameters(array $fields, bool $isSearch = false): self;


  /**
   * Returns the number of rows affected by a DELETE, INSERT or UPDATE statement.
   *
   * @return integer
   */
  public function numRows(): int;


  /**
   * A method to execute the prepared statement
   *
   * @return void
   */
  public function execute();


  /**
   * A method to return a single db row as an object.
   *
   * @return object
   */
  public function result(): Object;


  /**
   * A method to return all the db rows as an array.
   *
   * @return array
   */
  public function results(): array;


  /**
   * Returns the last inserted row id from database table
   *
   * @return integer
   */
  public function getLastId(): int;

}