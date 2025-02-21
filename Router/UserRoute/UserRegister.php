<?php
namespace Router\UserRegister;

include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Controller/UserController.php");

use App\Controller\UserController;
use PDOException;

header('Content-Type: application/json');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fullname = $_POST["Fullname"];
        $email = $_POST["Email"] ? filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL) : null;
        $password = $_POST["Password"];
        $confirm_password = $_POST["Confirm_Password"];

        if(!$fullname || !$email || !$password || !$confirm_password) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        }

        if($password !== $confirm_password) {
            echo json_encode(['status' => 'error', 'message' => 'Password not match.']);
            exit();
        }

        $UserController = new UserController();
        $result = $UserController->RegisterUser($fullname, $email, $password);
        if($result) {
            header ("location: /user_management/Views/Auth/Login.php");
            exit();
            // echo json_encode(['status' => 'success', 'message' => 'Register Successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => "Error yawa"]);
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());

        echo json_encode(['status' => 'error', 'message' => 'An internal error occurred. Please try again later.']);
    }
}