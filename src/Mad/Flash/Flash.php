<?php

declare(strict_types=1);

namespace Mad\Flash;

use Mad\GlobalManager\GlobalManager;

class Flash implements FlashInterface
{

    /**
     * A constant of flsh key
     */
    protected const FLASH_KEY = 'flash_message';


    /**
     * @inheritDoc
     *
     * @param string $message
     * @param [type] $type
     * @return void
     */
    public static function add(string $message, string $type = FlashTypes::SUCCESS): void
    {
        $session = GlobalManager::get('global_session');
        if (!$session->has(self::FLASH_KEY)) {
            $session->set(self::FLASH_KEY, []);
        }
        $session->setArray(self::FLASH_KEY, ['message' => $message, 'type' => $type]);
    }

    /**
     * @inheritDoc
     *
     * @return mixed
     */
    public static function get(): mixed
    {
        $session = GlobalManager::get('global_session');
        $session->flush(self::FLASH_KEY);
    }
}