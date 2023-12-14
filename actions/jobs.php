<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');
?>

<?php
// Example without a database connection

// Define an array of users
$users = [
    ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
    ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
    // ... add more users as needed
];

// Set header to return JSON
header('Content-Type: application/json');

// Convert array to JSON and print
echo json_encode($users);
?>