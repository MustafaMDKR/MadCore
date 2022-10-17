<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

use RuntimeException;

class BaseRuntimeException extends RuntimeException
{

    /**
     * An exception thrown if only runtime error occures.
     *
     * @param string                $message
     * @param integer               $code
     * @param RuntimeException|null $previous
     * @throws Exception
     */
    public function __construct(string $message, int $code = 0, RuntimeException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}