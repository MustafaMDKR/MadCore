<?php

declare(strict_types=1);

namespace Mad\Flash;

interface FlashInterface
{

    /**
     * A method to add a flsh message stored with the session
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function add(string $message, string $type = FlashTypes::SUCCESS): void;


    /**
     * A method to get all the messages within the session.
     *
     * @return mixed
     */
    public static function get(): mixed;

}