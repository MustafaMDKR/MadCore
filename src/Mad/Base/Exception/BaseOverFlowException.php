<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use OverflowException;

class BaseOverFlowException extends OverflowException
{

    /**
     * An exception thrown when adding an element to a full container.
     *
     * @param string                 $message
     * @param integer                $code
     * @param OverflowException|null $previous
     * @throws RuntimeException
     */
    public function __construct(string $message, int $code = 0, OverflowException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}