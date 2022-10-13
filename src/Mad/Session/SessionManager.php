<?php

declare (strict_types=1);

namespace Mad\Session;

use Mad\Session\Storage\NativeSessionStorage;
use Mad\Yaml\YamlConfig;

class SessionManager
{

    /**
     * A method to create an instance of our session factory and pass in the default 
     * session storage and we will fetch the session name and array of options from  
     * the core yaml configuration files.
     *
     * @return object
     */
    public static function intialize(): Object
    {
        $factory = new SessionFactory();
        return $factory->create('madcore', NativeSessionStorage::class, YamlConfig::file('session'));
    }
}