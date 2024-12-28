<?php
session_start();
include('db_connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_name = $_POST['teacher_name'] ?? null;
    $feedback = $_POST['feedback'] ?? null;
    $rating = $_POST['rating'] ?? null;

    if (!$teacher_name || !$feedback || !$rating) {
        echo "Missing required input data.";
        exit;
    }

    $student_username = $_SESSION['username'] ?? null; 
    if (!$student_username) {
        echo "Student not logged in.";
        exit;
    }

    $sql_student = "SELECT id FROM users WHERE username = ?";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("s", $student_username);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();
    $row_student = $result_student->fetch_assoc();

    if (!$row_student) {
        echo "Student not found.";
        exit;
    }

    $student_id = $row_student['id'];

    $sql_teacher = "SELECT * FROM teachers WHERE teacher_id = ?";

$stmt_teacher = $conn->prepare($sql_teacher);
$stmt_teacher->bind_param("s", $teacher_name);
if ($stmt_teacher->execute()) {
    $result_teacher = $stmt_teacher->get_result();
    $row_teacher = $result_teacher->fetch_assoc();
    if (!$row_teacher) {
        echo "Teacher with name '$teacher_name' not found in database.";
    } else {
        echo "Teacher ID found: " . $row_teacher['teacher_id'];
    }
} else {
    echo "Query error: " . $stmt_teacher->error;
}

    if (!$row_teacher) {
        echo "Teacher not found.";
        exit;
    }

    $teacher_id = $row_teacher['teacher_id'];

    $sql_feedback = "INSERT INTO feedbacks (teacher_id, student_id, feedback, rating, timestamp, teacher_name) 
                     VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt_feedback = $conn->prepare($sql_feedback);
    $stmt_feedback->bind_param("iisis", $teacher_id, $student_id, $feedback, $rating, $teacher_name);

    if ($stmt_feedback->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error inserting feedback: " . $stmt_feedback->error;
    }

    $stmt_student->close();
    $stmt_teacher->close();
    $stmt_feedback->close();
} else {
    echo "Invalid request method.";
}
$notification_query = "INSERT INTO notifications (teacher_id, message, seen, created_at) 
                       VALUES (?, ?, 0, NOW())";
$notification_stmt = $conn->prepare($notification_query);
$teacher_id = 1214;  
$message = "You have received new feedback!";
$notification_stmt->bind_param("is", $teacher_id, $message);
$notification_stmt->execute();
$notification_stmt->close();



$conn->close();
?>
