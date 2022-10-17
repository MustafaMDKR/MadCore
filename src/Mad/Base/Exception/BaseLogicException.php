<?php

declare (strict_types=1);

namespace Mad\Base\Exception;

use LogicException;

class BaseLogicException extends LogicException
{
    
    /**
     * An exception represents error in the program logic.
     * This kind of exceptions should lead to a fix in your code.
     *
     * @param string              $message
     * @param integer             $code
     * @param LogicException|null $previous
     * @throws Exception
     */
    public function __construct(string $message, int $code = 0, LogicException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}