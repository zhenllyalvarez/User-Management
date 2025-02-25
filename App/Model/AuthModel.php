<?php
namespace user_management\App\Model;
class AuthModel {
    public function CreateUser()
    {
        return $this->InsertUser();
    }

    public function LoginUser() {
        return $this->SelectUser();
    }

    private function InsertUser()
    {
        return "INSERT INTO users (fullname, email, password, created_at) VALUES (?,?,?,?)";
    }

    private function SelectUser() {
        return "SELECT * FROM users WHERE email = ?";
    }
}