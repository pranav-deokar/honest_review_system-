<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.html");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];
$rating_stats_query = "SELECT AVG(rating) as average_rating, COUNT(rating) as total_feedback 
                       FROM feedback WHERE teacher_id='$teacher_id'";
$rating_stats_result = $conn->query($rating_stats_query);
$stats = $rating_stats_result->fetch_assoc();
?>

<h1>Rating Statistics</h1>
<p>Average Rating: <?= round($stats['average_rating'], 2) ?></p>
<p>Total Feedback: <?= $stats['total_feedback'] ?></p>
