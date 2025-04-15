<?php

require_once 'User.php';
require_once 'Session.php';

class Authenticator {
    private static function getUsers(): array {
        return Session::get('registered_users') ?? [];
    }

    private static function saveUsers(array $users): void {
        Session::set('registered_users', $users);
    }

    public static function register(string $name, string $email, string $password): bool {
        $users = self::getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return false;
            }
        }

        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        
        self::saveUsers($users);
        return true;
    }

    public static function login(string $email, string $password): ?array {
        $users = self::getUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                Session::set('user', $user);
                return $user;
            }
        }
        return null;
    }

    public static function getCurrentUser(): ?array {
        return Session::get('user');
    }

    public static function logout(): void {
        Session::destroy();
    }


    public static function getAllUsers(): array {
        return self::getUsers();
    }
} 