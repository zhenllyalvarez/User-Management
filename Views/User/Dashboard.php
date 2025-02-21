<?php
    if(!isset($_COOKIE['isLoggedIn'])) {
        header('Location: /user_management/Views/Auth/Login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UM - Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="/user_management/Router/Logout/UserLogout.php">Logout</a>
</body>
</html>