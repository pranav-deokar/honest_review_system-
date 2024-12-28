<?php
session_start();

if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(['error' => 'Teacher ID is not set in session']);
    exit;
}

$teacher_id = $_SESSION['teacher_id'];  

include('db_connection.php');

$query = "
    SELECT feedbacks.feedback, feedbacks.rating, users.name AS student_name
    FROM feedbacks
    JOIN users ON feedbacks.student_id = users.id
    WHERE feedbacks.teacher_id = ?
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['error' => 'Prepare statement failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $teacher_id); 

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $feedbacks = [];

    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;  
    }

    if (count($feedbacks) > 0) {
        echo json_encode($feedbacks);
    } else {
        echo json_encode(['message' => 'No feedback available']);  
    }
} else {
    echo json_encode(['error' => 'Query execution failed: ' . $stmt->error]);  
}
?>
