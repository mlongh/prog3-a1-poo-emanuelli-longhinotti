<?php
require_once 'classes/Authenticator.php';
require_once 'classes/Session.php';

Session::start();
Authenticator::logout();

header('Location: login.php');
exit; 