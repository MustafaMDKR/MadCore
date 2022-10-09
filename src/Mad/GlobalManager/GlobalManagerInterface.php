<?php

declare(strict_types=1);

namespace Mad\GlobalManager;

interface GlobalManagerInterface
{

    /**
     * Set the Global variable
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public static function set(string $key, mixed $value): void;


    /**
     * Get the value of the set Global variable.
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed;
}