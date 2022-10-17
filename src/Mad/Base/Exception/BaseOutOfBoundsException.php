<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use OutOfBoundsException;

class BaseOutOfBoundsException extends OutOfBoundsException
{

    /**
     * An exception thrown if a value is not a valid key.
     * This represents errors that can not be detected at compile time.
     *
     * @param string                    $message
     * @param integer                   $code
     * @param OutOfBoundsException|null $previous
     * @throws RuntimeException
     */
    public function __construct(string $message, int $code = 0, OutOfBoundsException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}