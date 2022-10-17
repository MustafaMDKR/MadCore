<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use InvalidArgumentException;

class BaseInvalidArgException extends InvalidArgumentException
{

    /**
     * An exception thrown if an argument is not of an expected type
     *
     * @param string                        $message
     * @param integer                       $code
     * @param InvalidArgumentException|null $previous
     * @throws LogicException
     */
    public function __construct(string $message, int $code = 0, InvalidArgumentException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}