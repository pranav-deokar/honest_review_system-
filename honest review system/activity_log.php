<?php

include('db_connection.php');
session_start();
$teacher_id = $_SESSION['teacher_id']; 


$query = "SELECT * FROM activity_log WHERE teacher_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();


$activity_logs = [];
while ($row = $result->fetch_assoc()) {
    $activity_logs[] = $row;
}


$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
   
    <style>
        
        .activity-log-item {
            color: #3a271d !important;  
            font-weight: normal; 
        }
    </style>
</head>
<body>

    <header class="bg-custom text-white p-3">
        <div class="container">
            <h2>Activity Log</h2>
        </div>
    </header>

    <section class="container my-5">
        <ul id="activityList" class="list-group">
            <?php
            if (count($activity_logs) > 0) {
                foreach ($activity_logs as $log) {
                    
                    echo '<li class="list-group-item bg-light activity-log-item">';
                    echo htmlspecialchars($log['activity_description']);
                    echo '<br>Occurred on: ' . htmlspecialchars($log['timestamp']);
                    echo '</li>';
                }
            } else {
                echo '<li class="list-group-item bg-light activity-log-item">No activity found.</li>';
            }
            ?>
        </ul>
    </section>

</body>
</html>
