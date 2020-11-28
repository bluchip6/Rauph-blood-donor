<?php

namespace App\Services;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param array $values
     */
    public function set(array $values): void
    {
        $_SESSION = $values;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $_SESSION ?? null;
    }

    /**
     * @param string|null $key
     * @return $this
     */
    public function clear(?string $key = null): Session
    {
        if ($key === null) {
            session_destroy();
            $this->redirectUrl('/');
        }
        if ($key !== null && array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }

        return $this;
    }

    /**
     * @param string $url
     */
    public function redirectUrl(string $url = '/'): void
    {
        if (!empty($url)) {
            header('Location: ' . $url);
            exit();
        }
    }

    /**
     * @return $this
     */
    public function redirectIfNotAdmin(): Session
    {
        if ($this->get('role') !== 'admin') {
            $this->redirectUrl('/dashboard');
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function redirectIfNotAuth(): Session
    {
        if (!$this->get('auth')) {
            $this->redirectUrl('/login');
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->get('role') === 'admin';
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        return $this->get('auth') === true;
    }
}

