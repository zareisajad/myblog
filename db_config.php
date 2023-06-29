<?php
$servername = "localhost";
$username = "sajad";
$password = "sajad1992";
$dbname = "blog";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
