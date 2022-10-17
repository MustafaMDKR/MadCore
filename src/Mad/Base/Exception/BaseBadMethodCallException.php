<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use BadMethodCallException;

class BaseBadMethodCallException extends BadMethodCallException
{
    
    /**
     * An exception thrown if a callback refers to an undefined method 
     * or some of arguments are missing
     *
     * @param string                      $message
     * @param integer                     $code
     * @param BadMethodCallException|null $previous
     * @throws BadFunctionCallException
     */
    public function __construct(string $message, int $code = 0, BadMethodCallException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}