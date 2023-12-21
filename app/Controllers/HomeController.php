<?php

namespace App\Controllers;

use App\Models\UserModel;

class HomeController
{
    public function index()
    {
        $user1 = new UserModel();
        $is_logged = $user1->is_logged();
        require(__DIR__ . '../../../view/home.php');
    }
    public function fetchMoreUsers()
    {

        $moreUsers = [
            ['username' => 'test user A', 'email' => 'user1@example.com'],
            ['username' => 'test user B', 'email' => 'user2@example.com'],
        ];

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode(['users' => $moreUsers]);
        exit;
    }
}
