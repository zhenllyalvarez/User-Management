<?php
namespace Router\UserRegister;

use App\Controller\UserController;
use PDOException;

include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Controller/UserController.php");

header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        
        if(!$email || !$password) {
            echo  json_encode(["Status" => "error", "Code" => "400", "Message" => "Please fill up the input field properly."]);
            exit();
        }
        
        $UserController = new UserController();
        $resut = $UserController->LoginUser($email, $password);
        if($resut) {
            header("Location: /user_management/Views/User/Dashboard.php");
            // return json_encode(["Status" => "error", "Code" => "200", "Message" => "Success to login."]);
        } else {
            return json_encode(["Status" => "error", "Code" => "101", "Message" => "Failed to login."]);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return json_encode(['Status' => 'Error', "Code" => 404, "Message" => "There is an internal error for login Please try again."]);
    }
}