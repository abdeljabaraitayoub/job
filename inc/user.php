<?php
session_start();
include 'dbcon.php';

class User
{
    private $db;

    function __construct()
    {
        $this->db = new db();
    }

    function register($fullname, $password1, $email)
    {
        $password1 = password_hash($password1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users  (fullname,password,email) VALUES ('$fullname','$password1', '$email')";


        $result = $this->db->executeQuery($query);
        header('location:login.php ');
        return $result;
    }
    function login($email, $password)
    {
        $query = "select * from users where email = '$email'";
        $result = $this->db->executeQuery($query);
        $row = mysqli_fetch_array($result);
        if ($row["email"] == $email && password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["is_admin"] = $row["is_admin"];
            header('location:index.php');
        } else {
            header('location:login.php?error=1');
        }
    }
    function is_logged()
    {
        if (isset($_SESSION["id"])) {
            return true;
        } else {
            return false;
        }
    }
    function logout()
    {
        session_destroy();
        header('location:../index.php?');
    }
}
