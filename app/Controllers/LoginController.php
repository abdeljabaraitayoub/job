<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            $email = $_POST['email'];
            $user1 = new UserModel();
            // echo $email;
            // echo $password;
            // die();
            $user1->login($email, $password);
        }
        require(__DIR__ . '../../../view/login.php');
    }
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['username'];
            $password1 = $_POST['password1'];
            // dump($_POST);
            $email = $_POST['email'];
            $user1 = new UserModel();
            $user1->register($fullname, $password1, $email);
        } else {
            require(__DIR__ . '../../../view/signup.php');
        }
    }
    public function logout()
    {
        session_destroy();
        header('location:?route=home');
    }
}
