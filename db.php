<?php
$host = 'localhost';      // Hostname
$username = 'root';       // Default username for XAMPP
$password = '';           // Default password (leave empty for XAMPP)
$database = 'SIMS';       // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
