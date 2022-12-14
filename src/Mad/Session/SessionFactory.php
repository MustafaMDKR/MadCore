<?php

declare (strict_types=1);

namespace Mad\Session;

use Mad\Session\Exception\SessionStorageInvalidArgException;
use Mad\Session\Storage\SessionStorageInterface;

class SessionFactory
{

    /**
     * A main empty constructor
     */
    public function __construct()
    {
        
    }


    /**
     * A factory method to create the specified cache along with the specified
     * kind of session storage. After creating the session it will be registered 
     * at the session manager 
     *
     * @param string $sessionName
     * @param string $storageString
     * @param array  $options
     * @return SessionInterface
     */
    public function create(string $sessionName, string $storageString, array $options = []): SessionInterface
    {
        $storageObject = new $storageString($options);
        if (!$storageObject instanceof SessionStorageInterface) {
            throw new SessionStorageInvalidArgException($storageString . ' is not a valid session storage object');
        }
        return new Session($sessionName, $storageObject);
    }

}