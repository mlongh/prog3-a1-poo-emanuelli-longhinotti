<?php
require_once 'classes/Authenticator.php';
require_once 'classes/Session.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember_me']);

    if (!$email || !$password) {
        $_SESSION['error'] = 'Email and password are required.';
        header('Location: login.php');
        exit;
    }

    $user = Authenticator::login($email, $password);

    if ($user) {        
        if ($remember_me) {
            setcookie('remembered_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 days
        } else {
            setcookie('remembered_email', '', time() - 3600, '/');
        }
        
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
} 