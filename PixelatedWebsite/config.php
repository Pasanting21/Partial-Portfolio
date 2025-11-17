<?php
$host = "localhost";
$db = "pixel_art_app";
$user = "root";
$pass = "";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>