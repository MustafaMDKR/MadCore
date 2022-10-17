<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use UnderflowException;

class BaseUnderFlowException extends UnderflowException
{

    /**
     * An exception thrown when performing an invalid operation on an empty
     * container e.g. removing an element.
     *
     * @param string                  $message
     * @param integer                 $code
     * @param UnderflowException|null $previous
     * @throws RuntimeException
     */
    public function __construct(string $message, int $code = 0, UnderflowException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}