<?php
session_start();

include('db_connection.php'); 

$_SESSION['id'] = $user['id']; 
echo "Session ID: " . $_SESSION['id'];  



if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Student not logged in.']);
    exit;
}


$student_id = $_SESSION['id'];


$query = "SELECT feedback, course, timestamp FROM feedbacks WHERE student_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id); 
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;  
    }
    echo json_encode($feedbacks); 
} else {
    echo json_encode(['error' => 'No recent feedbacks found.']);  
}

$conn->close();  
?>
