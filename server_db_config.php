<?php
$servername = "localhost";
$username = "sajadzar_sajad";
$password = "pnqC6nSrw1P9C79P";
$dbname = "sajadzar_blog";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
