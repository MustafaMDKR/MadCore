<?php

declare (strict_types=1);

namespace Mad\Session;

use Mad\Session\Storage\NativeSessionStorage;

class SessionManager
{

    /**
     * A method to create an instance of our session factory and pass in the default 
     * session storage and we will fetch the session name and array of options from  
     * the core yaml configuration files.
     *
     * @return void
     */
    public static function intialize()
    {
        $factory = new SessionFactory();
        return $factory->create('', NativeSessionStorage::class, array());
    }
}