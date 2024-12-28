<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "honest_review_system"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
