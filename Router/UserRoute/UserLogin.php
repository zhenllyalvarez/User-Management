<?php
session_start();

include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Controller/UserController.php");
use App\Controller\UserController;
use PDOException;

header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        
        if(!$email || !$password) {
            echo json_encode([
                "Status" => "error", 
                "Code" => "400", 
                "Message" => "Please fill up the input field properly."
            ]);
            exit();
        }
        
        $UserController = new UserController();
        $result = $UserController->LoginUser($email, $password);
        $userRst = json_decode($result, true);
        if ($userRst['User'] && $userRst['User']['role'] === 'admin') {
            header("Location: /user_management/Views/Admin/AdminDashboard.php");
            exit();
        } else {
            header("Location: /user_management/Views/User/Dashboard.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return json_encode([
            'Status' => 'Error', 
            "Code" => 404, 
            "Message" => "There is an internal error for login Please try again."
        ]);
    }
}