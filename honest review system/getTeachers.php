<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "honest_review_system";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['department'])) {
    $department = $_GET['department'];

   
    $department = $conn->real_escape_string($department);

    
    $sql = "SELECT teacher_id, name FROM teachers WHERE department = '$department'";
    
    $result = $conn->query($sql);

    $teachers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teachers[] = $row;  
        }
        
        echo json_encode($teachers);
    } else {
        
        echo json_encode([]);
    }
} else {
    echo json_encode([]); 
}

$conn->close();
?>
