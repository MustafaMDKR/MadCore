<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use OutOfRangeException;

class BaseOutOfRangeException extends OutOfRangeException
{

    /**
     * An exception thrown when adding an element to a full container.
     *
     * @param string                   $message
     * @param integer                  $code
     * @param OutOfRangeException|null $previous
     * @throws LogicException
     */
    public function __construct(string $message, int $code = 0, OutOfRangeException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}
