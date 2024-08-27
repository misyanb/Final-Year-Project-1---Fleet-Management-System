<?php
$host = "localhost";
$dbUsername = "root";
$ps = "";
$dbName = "vehicle maintenance";

// Create connection
$conn = new mysqli($host, $dbUsername, $ps, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>