<?php
session_start();
require_once 'dbcon.php';

class User
{
    private $mydb;

    function __construct()
    {
        $this->mydb = new db();
    }

    function register($fullname, $password1, $email)
    {
        $password1 = password_hash($password1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users  (fullname,password,email) VALUES ('$fullname','$password1', '$email')";


        $result = $this->mydb->executeQuery($query);
        header('location:login.php ');
        return $result;
    }
    function login($email, $password)
    {
        $query = "select * from users where email = '$email'";
        $result = $this->mydb->executeQuery($query);
        $row = mysqli_fetch_array($result);
        if ($row["email"] == $email && password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["is_admin"] = $row["is_admin"];

            if ($row["is_admin"] == 0) {
                header('location:index.php');
            } elseif ($row["is_admin"] == 1) {
                header('location:dashboard/dashboard.php');
            } else {
                header('location:login.php?error=1');
            }
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
    function is_admin()
    {
        if ($_SESSION["is_admin"] != 1) {
            header('location:../index.php');
        }
    }
    function logout()
    {
        session_destroy();
        header('location:../index.php?');
    }
}
