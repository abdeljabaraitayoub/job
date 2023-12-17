<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');
session_start();
$job = new Jobs();

$result = $job->apply($_GET['id'], $_SESSION['id']);

if ($result) {
    echo "Job created successfully";
} else {
    echo "Error creating job";
}
header("location:../dashboard/emploit.php");
