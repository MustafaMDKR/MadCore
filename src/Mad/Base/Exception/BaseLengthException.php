<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use LengthException;

class BaseLengthException extends LengthException
{

    /**
     * An exception thrown if the length is invalid.
     *
     * @param string               $message
     * @param integer              $code
     * @param LengthException|null $previous
     * @throws LogicException
     */
    public function __construct(string $message, int $code = 0, LengthException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}