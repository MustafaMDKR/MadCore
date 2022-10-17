<?php

declare(strict_types=1);

namespace Mad\Base\Exception;

class BaseNoValueException extends BaseLogicException
{

    /**
     * A custom exception which is thrown when calling an empty argument.
     *
     * @param string                  $message
     * @param integer                 $code
     * @param BaseLogicException|null $previous
     * @throws LogicException
     */
    public function __construct(string $message, int $code = 0, BaseLogicException $previous = null)
    {
        parent::__construct($message, $code, $previous);        
    }
}