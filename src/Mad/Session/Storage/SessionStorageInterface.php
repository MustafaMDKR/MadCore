<?php

declare (strict_types=1);

namespace Mad\Session\Storage;

interface SessionStorageInterface
{

    public function setSessionName(string $sessionName): void;

    public function getSessionName(): string;

    public function setSessionID($sessionID): void;

    public function getSessionID();

    public function setSession(string $key, mixed $value): void;

    public function setArraySession(string $key, mixed $value): void;

    public function getSession(string $key, $default = null);

    public function deleteSession(string $key): bool;

    public function invalidate(): void;

    public function flush(string $key, $default = null);

    public function hasSession(string $key): bool;
}