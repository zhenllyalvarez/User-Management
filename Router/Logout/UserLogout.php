<?php

session_start();
session_unset();
session_destroy();

setcookie('isLoggedIn', $user['id'], time() + 86400, '/');
header('Location: /user_management/Views/Auth/Login.php');
exit();