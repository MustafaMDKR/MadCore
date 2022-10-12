<?php

declare(strict_types=1);

namespace Mad\Session;

use Mad\Session\Exception\SessionException;
use Mad\Session\Exception\SessionInvalidArgumentException;
use Mad\Session\Storage\SessionStorageInterface;
use Throwable;

class Session implements SessionInterface
{
    
    /**
     * @var SessionStorageInterface
     */
    protected SessionStorageInterface $storage;

    /**
     * @var string
     */
    protected string $sessionName;


    /**
     * @var string
     */
    protected const SESSION_PATTERN = '/^[a-zA-Z0-9_\.]{1,64}$/';


    /**
     * A main class constructor
     *
     * @param string                       $sessionName
     * @param SessionStorageInterface|null $storage
     * @throws SessionInvalidArgumentException
     */
    public function __construct(string $sessionName, SessionStorageInterface $storage = null)
    {
        if (false === $this->isSessionKeyValid($sessionName)) {
            throw new SessionInvalidArgumentException($sessionName.' is not a valid session name.');
        }
        $this->sessionName = $sessionName;
        $this->storage = $storage;
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     * @throws SessionException
     */
    public function set(string $key, mixed $value): void
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->setSession($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     * @throws SessionException
     */
    public function setArray(string $key, mixed $value): void
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->setArraySession($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $default
     * @return void
     * @throws SessionException
     */
    public function get(string $key, $default = null)
    {
        try {
            return $this->storage->getSession($key, $default);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }

    
    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     * @throws SessionException
     */
    public function delete(string $key): bool
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->deleteSession($key);
        } catch (Throwable $throwable) {
            throw new SessionException();
        }

        return true;
    }


    /**
     * @inheritDoc
     *
     * @return void
     */
    public function invalidate(): void
    {
        $this->storage->invalidate();
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     * @throws SessionException
     */
    public function flush(string $key, mixed $value = null)
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->flush($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException();
        }
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     * @throws SessionInvalidArgumentException
     */
    public function has(string $key): bool
    {
        $this->ensureSessionKeyIsValid($key);

        return $this->storage->hasSession($key);
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     */
    protected function isSessionKeyValid(string $key): bool
    {
        return (preg_match(self::SESSION_PATTERN, $key) === 1);
    }


    /**
     * @inheritDoc
     *
     * @param string $key
     * @return void
     */
    protected function ensureSessionKeyIsValid(string $key): void
    {
        if (false === $this->isSessionKeyValid($key)) {
            throw new SessionInvalidArgumentException($key.' is not a valid session key.');
        }
    }
}
