<?php

class db
{
    public $server = 'localhost';
    public $dbusername = 'root';
    public $dbpassword = '';
    public $dbname = 'oop';
    public $conn;

    function __construct()
    {
        $this->conn = mysqli_connect($this->server, $this->dbusername, $this->dbpassword, $this->dbname);

        // Check the connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function closeConnection()
    {
        // Close the connection when it's no longer needed
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    function executeQuery($query)
    {
        // Execute the query using the class connection
        $result = mysqli_query($this->conn, $query);

        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($this->conn));
        }

        return $result;
    }
}
