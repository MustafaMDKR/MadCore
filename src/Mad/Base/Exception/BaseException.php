<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use Exception;

class BaseException extends Exception
{
    
    /**
     * A main class constructor which allows overriding of SPL exceptions to add custom 
     * message within the core framework 
     *
     * @param string         $message
     * @param integer        $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}