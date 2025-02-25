<?php
    session_start();

    if(!isset($_SESSION['id']) && !isset($_SESSION['role'])) {
        header('Location: /user_management/Views/Auth/Login.php');
        exit();
    } elseif($_SESSION['role'] === 'user') {
        header("Location: /user_management/Views/User/Dashboard.php");
        exit();
    }

    $fullname = isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : "Admin";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Admin | Dashboard</title>
</head>

<body>
    <div class="p-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Admin</h1>
        <p class="text-2xl font-semibold text-gray-800 mb-4">Welcome admin, <?php echo $fullname ?></p>
        <a class="py-2 px-4 bg-red-500 hover:bg-red-600 rounded text-white" href="/user_management/Router/Logout/UserLogout.php">Logout</a>
    </div>
</body>

</html>