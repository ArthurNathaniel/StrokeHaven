<?php
$host = "localhost";
$db_name = "strokehaven";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
