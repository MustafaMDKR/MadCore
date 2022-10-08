<?php

declare (strict_types=1);

namespace Mad\Session;

use Mad\Session\Exception\SessionStorageInvalidArgException;
use Mad\Session\Storage\SessionStorageInterface;

class SessionFactory
{

    public function __construct()
    {
        
    }

    public function create(string $sessionName, string $storageString, array $options = []): SessionInterface
    {
        $storageObject = new $storageString($options);
        if (!$storageObject instanceof SessionStorageInterface) {
            throw new SessionStorageInvalidArgException($storageString . ' is not a valid session storage object');
        }
        return new Session($sessionName, $storageObject);
    }

}