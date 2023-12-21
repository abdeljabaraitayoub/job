<?php

namespace App\Models;


class UserModel
{
    private $db;

    public function __construct()
    {
        // Get an instance of the Database class
        $this->db = Database::getInstance()->getConnection();
    }

    function register($fullname, $password1, $email)
    {
        $password1 = password_hash($password1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users  (fullname,password,email) VALUES ('$fullname','$password1', '$email')";

        // dump($query);
        $result = $this->db->query($query);
        header('location:?route=login');
        return $result;
    }
    function login($email, $password)
    {
        $query = "select * from users where email = '$email'";
        $result = $this->db->query($query);
        $row = mysqli_fetch_array($result);
        // dump($row);
        if ($row["email"] == $email && password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["is_admin"] = $row["is_admin"];
            // dump($_SESSION);
            if ($row["is_admin"] == 0) {
                header('location:?route=home');
            } elseif ($row["is_admin"] == 1) {
                header('location:?route=dashboard');
            } else {
                header('location:route=login');
            }
        } else {
            header('location:?route=login');
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
            header('location:../?route=home');
        }
    }
    function logout()
    {
        session_destroy();
        header('location:../?route=home');
    }

    public function getAllUsers()
    {
        // Fetch data from the "users" table
        $result = $this->db->query("SELECT * FROM users");

        // Check for errors
        if (!$result) {
            die("Error: " . $this->db->error);
        }

        // Fetch data as an associative array
        $users = $result->fetch_all(MYSQLI_ASSOC);

        return $users;
    }
}
