<?php
$servername = "206.189.114.113";
$username = "admin";
$password = "BrettSSH84!adMin";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
