<?php
declare(strict_types=1);

namespace Mad\DatabaseConnection\Exception;

use PDOException;

class DatabaseConnectionException extends PDOException
{

  /**
   * Main constructor class which overrides the parent constructor and set
   * the message and code properties which are optional
   *
   * @param string $message
   * @param int $code
   */
  public function __construct($message = null, $code = null)
  {
    $this->message = $message;
    $this->code = $code;
  }


}