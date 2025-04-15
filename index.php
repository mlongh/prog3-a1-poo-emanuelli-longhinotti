<?php
require_once 'classes/Session.php';

Session::start();

if (Session::isAuthenticated()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit; 