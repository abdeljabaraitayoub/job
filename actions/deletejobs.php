<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');
$job = new Jobs();
$jobs = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $jobs = $job->delete($id);
}
header("location:../dashboard/emploit.php");
