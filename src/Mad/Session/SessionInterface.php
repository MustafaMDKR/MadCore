<?php

declare (strict_types=1);

namespace Mad\Session;

interface SessionInterface
{
    /**
     * A method to set a specific vlaue to a specific key
     * of the session
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     * @throws SessionInvalidArgumentException MUST be thrown if the $key string is not a legal value.
     */
    public function set(string $key, mixed $value): void;


    /**
     * A method to set the specific value to a specific array key 
     * of the session
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     * @throws SessionInvalidArgumentException MUST be thrown if the $key string is not a legal value.
     */
    public function setArray(string $key, mixed $value): void;

    
    /**
     * A method to return the value of a specific key of
     * the session
     *
     * @param string $key
     * @param mixed $default
     * @return void
     * @throws SessionInvalidArgumentException MUST be thrown if the $key string is not a legal value.
     */
    public function get(string $key, $default = null);


    /**
     * A method to remove the value for the specified key
     * from the session
     *
     * @param string $key
     * @return boolean
     * @throws SessionInvalidArgumentException
     */
    public function delete(string $key): bool;


    /**
     * A method to destroy the session along with the session cookies
     *
     * @since 1.0.0
     * @return void
     */
    public function invalidate(): void;


    /**
     * A method to return the requested value and remove it from the session
     *
     * @since 1.0.0
     * @param string $key - The key to retrieve and remove the value for.
     * @param mixed $default - The default value to return if the requested value cannot be found
     * @return mixed
     */
    public function flush(string $key, mixed $value = null);


    /**
     * A method to determine whether an item is present in the session.
     *
     * @param string $key The session item key.
     * @return bool
     * @throws SessionInvalidArgumentException  MUST be thrown if the $key string is not a legal value.
     */
    public function has(string $key): bool;

    
}
