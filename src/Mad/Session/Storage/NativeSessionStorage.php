<?php

declare (strict_types=1);

namespace Mad\Session\Storage;

class NativeSessionStorage extends AbstractSessionStorage
{

    /**
     * Main class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public function setSession(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public function setArraySession(string $key, mixed $value): void
    {
        $_SESSION[$key][] = $value;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $default
     * @return void
     */
    public function getSession(string $key, $default = null)
    {
        if ($this->hasSession($key)) {
            return $_SESSION[$key];
        }
        return $default;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return void
     */
    public function deleteSession(string $key): void
    {
        if ($this->hasSession($key)) {
            unset($_SESSION[$key]);
        }
    }


    /**
     * @inheritDoc
     *
     * @return void
     */
    public function invalidate(): void
    {
        $_SESSION = array();

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setCookie($this->getSessionName(), '', time() - $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_unset();
        session_destroy();
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $default
     * @return void
     */
    public function flush(string $key, $default = null)
    {
        if ($this->hasSession($key)) {
            $value = $_SESSION[$key];
            $this->deleteSession($key);
            return $value;
        }
        return $default;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     */
    public function hasSession(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}