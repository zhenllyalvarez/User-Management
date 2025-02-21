<?php

namespace App\Controller;
include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Database/Database.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Model/UserModel.php");

use user_management\App\Model\UserModel;
use user_management\App\Database\Database;
use PDOException;
use PDO;

header('Content-Type: application/json');
class UserController
{
    public function RegisterUser($fullname, $email, $password)
    {
        try {
            $db = new Database();
            if($db->getStatus()) {
                $um = new UserModel();
                $stmt = $db->getConnection()->prepare($um->CreateUser());
                $hashPasword = password_hash($password, PASSWORD_DEFAULT);
                $created_at = date('Y-m-d H:i:s');
                $stmt->execute([$fullname, $email, $hashPasword, $created_at]);
                if($stmt->rowCount() > 0) {
                    return ["Status" => "Success", "Code" => 201, "Message" => "Successful registration."];
                } else {
                    return ["Status" => "fail", "Code" => 400, "Message" => "Failed to register"];
                }
            } else {
                return ["Status" => "Error", "Code" => 406, "Message" => "There is an error for register."];
            }
        } catch (PDOException $e) {
            return ["Status" => "Error", "Code" => 500, "Message" => "An internal error occurred. Please try again later."];
        }
    }

    public function LoginUser($email, $password) {
        try {
            $db = new Database();
            if($db->getStatus()) {
                $um = new UserModel();
                $stmt = $db->getConnection()->prepare($um->LoginUser());
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if($user && password_verify($password, $user['password'])) {
                    setcookie('isLoggedIn', $user['id'], time() + 86400, '/');
                    $_SESSION['user'] = $user['id'];
                } else  {
                    return 201;
                }
            } else {
                return 406;
            }
        } catch (PDOException $e) {
            return 404;
        }
    }
}
