<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use UnexpectedValueException;

class BaseUnexpectedValueException extends UnexpectedValueException
{

    /**
     * An exception thrown if a value does not match with a set of values.
     * Typically this happens when a function calls another function and expects
     * a specific type pf return
     *
     * @param string                        $message
     * @param integer                       $code
     * @param UnexpectedValueException|null $previous
     * @throws RuntimeException
     */
    public function __construct(string $message, int $code = 0, UnexpectedValueException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}