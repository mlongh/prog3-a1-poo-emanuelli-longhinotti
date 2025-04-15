<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'classes/Authenticator.php';
require_once 'classes/Session.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: register.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('Location: register.php');
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: register.php');
        exit;
    }

    if (Authenticator::register($name, $email, $password)) {
        $_SESSION['success'] = 'Registration successful! Please login.';
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['error'] = 'Email already exists.';
        header('Location: register.php');
        exit;
    }
} else {
    header('Location: register.php');
    exit;
} 