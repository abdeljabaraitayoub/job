<?php

// session_start();
require_once 'dbcon.php';
class jobs
{
    private $mydb;

    function __construct()
    {
        $this->mydb = new db();
    }
    function read($search1, $search2, $search3,)
    {
        $query = "SELECT * FROM jobs  WHERE status='Open'";

        $conditions = [];

        if (!empty($search1)) {
            $conditions[] = "jobs.title LIKE '%$search1%'";
        }

        if (!empty($search2)) {
            $conditions[] = "jobs.company LIKE '%$search2%'";
        }

        if (!empty($search3)) {
            $conditions[] = "jobs.location LIKE '%$search3%'";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' OR ', $conditions);
        }
        $result = $this->mydb->executeQuery($query);

        $rows = array();

        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
    function delete($jobId)
    {
        // Build the DELETE query
        $query = "DELETE FROM jobs WHERE id = '$jobId'";

        // Execute the query
        $result = $this->mydb->executeQuery($query);

        // Check the result
        if ($result) {
            // Check if any rows were affected
            if (mysqli_affected_rows($this->mydb->conn) > 0) {
                return true; // Job was successfully deleted
            } else {
                return false; // No job was deleted (perhaps the ID didn't exist)
            }
        } else {
            // The query failed
            return false;
        }
    }
    function create($title, $description, $company, $location, $status, $image)
    {
        // Connection - replace 'your_db_connection' with your actual connection variable
        $mysqli = mysqli_connect('localhost', 'root', '', 'oop');

        // Prepare the INSERT query using prepared statements
        $query = "INSERT INTO jobs (title, description, company, location, status, image) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $mysqli->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            // Handle errors, e.g., log them and return false
            error_log("Error preparing statement: " . $mysqli->error);
            return false;
        }

        // Bind parameters - 'sssssb' denotes the types of the variables: string, string, string, string, string, and blob
        $null = NULL;
        $stmt->bind_param('sssssb', $title, $description, $company, $location, $status, $null);

        // Send large data in packets
        $stmt->send_long_data(5, $image);

        // Execute the query
        $result = $stmt->execute();

        // Check the result
        if ($result) {
            // Job was successfully created
            $stmt->close();
            return true;
        } else {
            // The query failed
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
    function modifyJob($job_id, $title, $description, $company, $location, $status, $image)
    {
        // Connection - Use your actual database connection details
        $mysqli = mysqli_connect('localhost', 'root', '', 'oop');

        // Prepare the UPDATE query using prepared statements
        $query = "UPDATE jobs SET title = ?, description = ?, company = ?, location = ?, status = ?, image = ? WHERE id = $job_id";

        // Prepare the statement
        $stmt = $mysqli->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            // Handle errors, e.g., log them and return false
            error_log("Error preparing statement: " . $mysqli->error);
            return false;
        }

        // Bind parameters - 'sssssb' for the strings and blob, 'i' for the integer
        $null = NULL;
        $stmt->bind_param('sssssb', $title, $description, $company, $location, $status, $null);

        // Send large data in packets for the image
        $stmt->send_long_data(5, $image);

        // Execute the query
        $result = $stmt->execute();

        // Check the result
        if ($result) {
            // Job was successfully modified
            $stmt->close();
            return true;
        } else {
            // The query failed
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }


    function readoffres()
    {
        // $id = $_SESSION["id"];
        $query = "SELECT * FROM `offres` JOIN jobs ON offres.idjob=jobs.id JOIN users ON offres.iduser=users.id where offres.STATUS ='pending'";

        $result = $this->mydb->executeQuery($query);

        $rows = array();

        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
    function apply($jobid, $userid)
    {
        $query = "INSERT INTO `offres` ( `idjob`, `iduser`, `STATUS`) VALUES ( '$jobid', '$userid', 'pending');";

        $result = $this->mydb->executeQuery($query);
    }
    function accept($offreid)
    {
        $query = "UPDATE `offres` SET `STATUS` = 'accepted' WHERE `offres`.`idoffre` = $offreid";

        $result = $this->mydb->executeQuery($query);
    }
    function refuse($offreid)
    {
        $query = "UPDATE `offres` SET `STATUS` = 'refused' WHERE `offres`.`idoffre` = $offreid";

        $result = $this->mydb->executeQuery($query);
    }
    function is_accepted($jobid)
    {
        $id = $_SESSION["id"];
        $query = "SELECT * FROM `offres` JOIN jobs ON offres.idjob=jobs.id JOIN users ON offres.iduser=users.id where users.id=$id and jobs.id=$jobid";

        $result = $this->mydb->executeQuery($query);

        if ($status = mysqli_fetch_array($result)) {
            return $status['STATUS'];
        }
    }
    function countTotalJobOffers()
    {
        $query = "SELECT COUNT(*) as total FROM jobs";
        $result = $this->mydb->executeQuery($query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    function countActiveJobOffers()
    {
        $query = "SELECT COUNT(*) as total FROM jobs WHERE status='open'";
        $result = $this->mydb->executeQuery($query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    function countInactiveJobOffers()
    {
        $query = "SELECT COUNT(*) as total FROM jobs WHERE status='closed'";
        $result = $this->mydb->executeQuery($query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    function countApprovedJobOffers()
    {
        $query = "SELECT COUNT(*) as total FROM offres WHERE STATUS='accepted'";
        $result = $this->mydb->executeQuery($query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}
