<?php

namespace App\Controller;
include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Database/Database.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Model/AuthModel.php");

use user_management\App\Model\AuthModel;
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
                $um = new AuthModel();
                $stmt = $db->getConnection()->prepare($um->CreateUser());
                $hashPasword = password_hash($password, PASSWORD_DEFAULT);
                $created_at = date('Y-m-d H:i:s');
                $stmt->execute([$fullname, $email, $hashPasword, $created_at]);
                if($stmt->rowCount() > 0) {
                    return json_encode([
                        "Status" => "Success",
                        "Code" => 201,
                        "Message" => "Successfully created."
                    ]);
                } else {
                    return 404;
                }
            } else {
                return 406;
            }
        } catch (PDOException $e) {
            return 404;
        }
    }

    public function loginUser($email, $password) {
        try {
            $db = new Database();
            if (!$db->getStatus()) {
                return json_encode([
                    "Status" => "Error",
                    "Code" => 500,
                    "Message" => "Database connection failed."
                ]);
            }
            $authModel = new AuthModel();
            $stmt = $db->getConnection()->prepare($authModel->LoginUser());
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['fullname'] = $user['fullname'];
    
                return json_encode([
                    "Status" => "Success",
                    "Code" => 200,
                    "Message" => "Successfully logged in.",
                    "User" => [
                        "id" => $user['id'],
                        "role" => $user['role'],
                        // "fullname" => $user['fullname']
                    ]
                ]);
            } else {
                return json_encode([
                    "Status" => "Error",
                    "Code" => 401,
                    "Message" => "Invalid email or password."
                ]);
            }
        } catch (PDOException $e) {
            error_log("Login Error: " . $e->getMessage());
    
            return json_encode([
                "Status" => "Error",
                "Code" => 500,
                "Message" => "An internal error occurred. Please try again later."
            ]);
        }
    }
    
}
