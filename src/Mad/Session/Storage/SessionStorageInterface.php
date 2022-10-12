<?php

declare (strict_types=1);

namespace Mad\Session\Storage;

interface SessionStorageInterface
{

    /**
     * A method of session name wrapper with explicit argument to set a 
     * session name.
     *
     * @param string $sessionName
     * @return void
     */
    public function setSessionName(string $sessionName): void;


    /**
     * A method to return the name of the session
     *
     * @return string
     */
    public function getSessionName(): string;


    /**
     * A method of session ID wrapper with explicit argument to set
     * a session ID
     *
     * @param string $sessionID
     * @return void
     */
    public function setSessionID(string $sessionID): void;


    /**
     * A method to return the current session ID
     *
     * @return void
     */
    public function getSessionID();


    /**
     * A method to set a specific value to a specific key of the session
     *
     * @param string $key   The key of the item to store
     * @param mixed  $value The value of the item to store, Must be Serializable
     * @return void
     * @throws SessionStorageInvalidArgException Must be thrown if the key string is not a legal value
     */
    public function setSession(string $key, mixed $value): void;


    /**
     * A method to set the specific value to a specific array key of the session
     *
     * @param string $key   The key of the item to store
     * @param mixed  $value The value of the item to store, Must be Serializable.
     * @return void
     * @throws SessionStorageInvalidArgException Must be thrown if the key string is not a legal value
     */
    public function setArraySession(string $key, mixed $value): void;


    /**
     * A method to return the value of a specific key of the session
     *
     * @param string $key     The key of the item to store
     * @param mixed $default The default value to return if the requested value can't be found
     * @return mixed
     * @throws SessionStorageInvalidArgException Must be thrown if the key string is not a legal value
     */
    public function getSession(string $key, $default = null);


    /**
     * A method to remove the value for the specified key from the session
     *
     * @param string $key  The key of the item which will be unset
     * @return void
     * @throws SessionStorageInvalidArgException
     */
    public function deleteSession(string $key): void;


    /**
     * A method to destroy the session along with session cookies. 
     *
     * @return void
     */
    public function invalidate(): void;


    /**
     * A method to return the requested value and remove it from the session
     *
     * @param string $key       The key to retrieve and remove the value from
     * @param mixed $default    The default value to return if the requested value can't be found
     * @return mixed
     */
    public function flush(string $key, $default = null);


    /**
     * A method to determine whether an item exists in the session
     *
     * @param string $key   The session item key
     * @return boolean
     * @throws SessionStorageInvalidArgException  Must be thrown if the key string is not a legal value
     */
    public function hasSession(string $key): bool;
}