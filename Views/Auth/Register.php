<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img" href="/user_management/Assets/Img/tab-icon.jpg">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>User Management - Register</title>
</head>

<body>
    <div class="flex bg-gray-100 justify-center items-center h-screen">
        <div class="bg-white shadow-md w-sm rounded px-8 py-4">
            <h1 class="flex justify-center font-bold text-2xl mb-4">Register</h1>
            <div class="border border-gray-200 mx-4 mt-6 mb-6"></div>
            <form class="flex flex-col mb-2" action="/user_management/Router/UserRoute/UserRoute.php" method="post">
                <div class="flex flex-col">
                    <label class="" for="">Fullname</label>
                    <input class="border border-gray-400 bg-white p-2 mb-2 rounded" name="Fullname" type="text" placeholder="John Doe">
                </div>
                <div class="flex flex-col ">
                    <label class="font-normal text-sm" for="">Email</label>
                    <input class=" border border-gray-400 bg-white p-2 mb-2 rounded focus:outline-none" name="Email" type="email" placeholder="example@gmail.com">
                </div>
                <div class="flex flex-col ">
                    <label class="font-normal text-sm" for="">Password</label>
                    <input class=" border border-gray-400 bg-white p-2 mb-2 focus:outline-none rounded" name="Password" type="password" placeholder="********">
                </div>
                <div class="flex flex-col ">
                    <label class="font-normal text-sm" for="">Confirm Password</label>
                    <input class="border border-gray-400 bg-white p-2 mb-2 focus:outline-none rounded" name="Confirm_Password" type="password" placeholder="********">
                </div>
                <div class="">
                    <button class="bg-blue-500 w-full text-white p-2 rounded hover:bg-blue-600 cursor-pointer">Register</button>
                </div>
            </form>
            <div>
                <div class="flex justify-center mb-4 mt-4 gap-1">
                    <p class="text-sm">Already have an account?</p>
                    <a class="text-sm text-blue-600 hover:text-blue-700" href="/user_management/Views/Auth/Login.php">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>