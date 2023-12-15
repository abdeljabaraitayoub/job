<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');
?>

<?php
$job = new Jobs();
$jobs = "";
if (isset($_GET["keywords"]) && isset($_GET["locations"]) && isset($_GET["company"])) {
    $keywords = $_GET["keywords"];
    $location = $_GET["locations"];
    $company = $_GET["company"];
    $jobs = $job->read($keywords, $location, $company);
}
// $jobs = [
//     ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
//     ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
// ];
header('Content-Type: application/json');

echo json_encode($jobs);
?>