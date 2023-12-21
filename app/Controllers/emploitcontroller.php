<?php

namespace App\Controllers;

use App\Models\offerModel;

class emploitcontroller
{
    public function emploit()
    {
        $offer = new offerModel();
        $rows = $offer->read("", "", "",);
        require(__DIR__ . '../../../view/emploit.php');
    }
    public function delete()
    {
        $offer = new offerModel();
        $rows = $offer->delete($_GET['id']);
        header('Location:?route=emploit');
    }
    public function modify()
    {
        $offer = new offerModel();
        // dump($_POST);
        if (isset($_POST['createJob'])) {
            $job_id = $_GET['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $company = $_POST['company'];
            $location = $_POST['location'];
            $status = $_POST['status'];
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
            // echo ($imageData);
            $result = $offer->modifyJob($job_id, $title, $description, $company, $location, $status, $imageData);
            header('Location:?route=emploit');
        }
        require(__DIR__ . '../../../view/modifyemploit.php');
    }
    public function create()
    {
        $offer = new offerModel();
        // dump($_POST);
        if (isset($_POST['createJob'])) {
            // $job_id = $_GET['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $company = $_POST['company'];
            $location = $_POST['location'];
            $status = $_POST['status'];
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
            // echo ($imageData);
            $result = $offer->create($title, $description, $company, $location, $status, $imageData);
            header('Location:?route=emploit');
        }
        require(__DIR__ . '../../../view/createemploit.php');
    }
    public function apply()
    {
        $offer = new offerModel();
        $result = $offer->apply($_GET['id'], $_SESSION['id']);
        header('Location:?route=home');
    }
}
