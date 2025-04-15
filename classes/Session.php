<?php

class Session {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value): void {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function destroy(): void {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    public static function isAuthenticated(): bool {
        return self::get('user') !== null;
    }
} 