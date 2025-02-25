<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: /user_management/Views/Admin/AdminDashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: /user_management/Views/User/Dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img" href="/user_management/Assets/Img/tab-icon.jpg">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>User Management | Login</title>
</head>

<body>
    <div class="flex bg-gray-100 justify-center items-center h-screen">
        <div class="bg-white shadow-md w-sm rounded px-8 py-4">
            <h1 class="flex justify-center font-bold text-2xl mb-4">Login</h1>
            <div class="border border-gray-200 mx-4 mt-6 mb-6"></div>
            <form class="flex flex-col gap-4 mb-2" action="/user_management/Router/UserRoute/UserLogin.php" method="post">
                <div class="flex flex-col gap-2">
                    <label class="font-normal text-sm" for="">Email</label>
                    <input class=" border border-gray-400 bg-white p-2 rounded focus:outline-none" name="Email" type="email" placeholder="example@gmail.com">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="font-normal text-sm" for="">Password</label>
                    <input class=" border border-gray-400 bg-white p-2 focus:outline-none rounded" name="Password" type="password" placeholder="********">
                </div>
                <div class="">
                    <button class="bg-blue-500 w-full text-white p-2 rounded hover:bg-blue-600 cursor-pointer">Login</button>
                </div>
            </form>
            <div class="flex flex-col gap-2 mt-4">
                <p class="flex justify-center text-sm font-normal">Not a member?</p>
                <div class="flex justify-center mb-4">
                    <a href="/user_management/Views/Auth/Register.php" class="border w-50 text-gray-500 p-2 text-center rounded hover:bg-gray-100 cursor-pointer">Create an account</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>