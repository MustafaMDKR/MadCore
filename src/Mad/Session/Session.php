<?php

declare(strict_types=1);

namespace Mad\Session;

use Mad\Session\Exception\SessionException;
use Mad\Session\Exception\SessionInvalidArgumentException;
use Mad\Session\Storage\SessionStorageInterface;
use Throwable;

class Session implements SessionInterface
{
    protected const SESSION_PATTERN = '/^[a-zA-Z0-9_\.]{1,64}$/';
    protected SessionStorageInterface $storage;

    protected string $sessionName;

    public function __construct(string $sessionName, SessionStorageInterface $storage = null)
    {
        if (false === $this->isSessionKeyValid($sessionName)) {
            throw new SessionInvalidArgumentException($sessionName.' is not a valid session name.');
        }
        $this->sessionName = $sessionName;
        $this->storage = $storage;
    }

    public function set(string $key, mixed $value): void
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->setSession($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }

    public function setArray(string $key, mixed $value): void
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->setArraySession($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }

    public function get(string $key, $default = null)
    {
        try {
            return $this->storage->getSession($key, $default);
        } catch (Throwable $throwable) {
            throw new SessionException('An exception was thrown in retrieving the key from the session storage '.$throwable);
        }
    }

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

    public function invalidate(): void
    {
        $this->storage->invalidate();
    }

    public function flush(string $key, mixed $value)
    {
        $this->ensureSessionKeyIsValid($key);

        try {
            $this->storage->flush($key, $value);
        } catch (Throwable $throwable) {
            throw new SessionException();
        }
    }

    public function has(string $key): bool
    {
        $this->ensureSessionKeyIsValid($key);

        return $this->storage->hasSession($key);
    }

    protected function isSessionKeyValid(string $key): bool
    {
        return 1 === preg_match(self::SESSION_PATTERN, $key);
    }

    protected function ensureSessionKeyIsValid(string $key): void
    {
        if (false === $this->isSessionKeyValid($key)) {
            throw new SessionInvalidArgumentException($key.' is not a valid session key.');
        }
    }
}
