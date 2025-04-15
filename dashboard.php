<?php
require_once 'classes/Authenticator.php';
require_once 'classes/Session.php';

Session::start();

if (!Session::isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$user = Authenticator::getCurrentUser();
$remembered_email = $_COOKIE['remembered_email'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>
        <?php if ($remembered_email): ?>
            <p>Your email is saved in cookies for easier login next time.</p>
        <?php endif; ?>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html> 