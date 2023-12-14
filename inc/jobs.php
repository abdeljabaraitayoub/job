<?php
// include 'dbcon.php';

class jobs
{
    private $db;

    function __construct()
    {
        $this->db = new db();
    }
    function read($search1, $search2, $search3,)
    {
        $query = "SELECT * FROM jobs";

        $conditions = [];

        if (!empty($search1)) {
            $conditions[] = "title LIKE '%$search1%'";
        }

        if (!empty($search2)) {
            $conditions[] = "company LIKE '%$search2%'";
        }

        if (!empty($search3)) {
            $conditions[] = "location LIKE '%$search3%'";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' OR ', $conditions);
        }
        $result = $this->db->executeQuery($query);

        $rows = array();

        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function search($searchTerm)
    {
        $stmt = "SELECT * FROM jobs WHERE title LIKE '%$searchTerm%' OR company LIKE '%$searchTerm%' OR location LIKE '%$searchTerm%'";
        $result = $this->db->executeQuery($stmt);
        $searchResults = [];

        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }

        return $searchResults;
    }
}
