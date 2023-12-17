<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');

$job = new Jobs();
$job_id = $_GET["id"];
if (isset($_POST["createJob"])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    // Open and read the image file
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
    $result = $job->modifyJob($job_id, $title, $description, $company, $location, $status, $imageData);
}
header("location:../dashboard/emploit.php");
