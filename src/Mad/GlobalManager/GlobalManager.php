<?php

declare(strict_types=1);

namespace Mad\GlobalManager;

use Mad\GlobalManager\Exception\GlobalManagerException;
use Mad\GlobalManager\Exception\GlobalManagerInvalidArgException;
use Throwable;

class GlobalManager implements GlobalManagerInterface
{

    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $GLOBALS[$key] = $value;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        self::isGlobalValid($key);
        try {
            return $GLOBALS[$key];
        } catch (Throwable $throwable) {
            throw new GlobalManagerException('An exception was thrown trying to retrieve the data.');
        }
    }


    /**
     * A method to check if we have a valid key and it is not empty else 
     * throw an exception
     * 
     * @param string $key
     * @return void
     * @throws GlobalManagerInvalidArgException
     */
    private static function isGlobalValid(string $key): void
    {
        if (!isset($GLOBALS[$key])) {
            throw new GlobalManagerInvalidArgException('Invalid global key. Please you have set the global state for ' . $key);
        }
        if (empty($key)) {
            throw new GlobalManagerInvalidArgException('Argument can not be empty.');
        }
    }


}