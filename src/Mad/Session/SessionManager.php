<?php

declare (strict_types=1);

namespace Mad\Session;

use Mad\Session\Storage\NativeSessionStorage;

class SessionManager
{

    public static function intialize()
    {
        $factory = new SessionFactory();
        return $factory->create('', NativeSessionStorage::class, array());
    }
}