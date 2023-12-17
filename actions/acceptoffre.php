<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');

$job = new Jobs();
if (isset($_GET['id'])) {
    $job->accept($_GET['id']);
}


header("location:../dashboard/candidat.php");
