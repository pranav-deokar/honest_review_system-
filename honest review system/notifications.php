<?php
include('db_connection.php');
session_start();
$teacher_id = $_SESSION['teacher_id'];  

$query = "SELECT * FROM notifications WHERE teacher_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$update_seen_query = "UPDATE notifications SET seen = 1 WHERE teacher_id = ? AND seen = 0";
$update_stmt = $conn->prepare($update_seen_query);
$update_stmt->bind_param("i", $teacher_id);
$update_stmt->execute();
$update_stmt->close();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="bg-custom text-white p-3">
        <div class="container">
            <h2>Notifications</h2>
        </div>
    </header>

    <section class="container my-5">
        <ul id="notificationList" class="list-group">
            <?php
            if (count($notifications) > 0) {
                foreach ($notifications as $notification) {
                   
                    echo '<li class="list-group-item notification-item">';
                    echo htmlspecialchars($notification['message']);
                    echo '<br>Received on: ' . htmlspecialchars($notification['created_at']);
                    
                    $seen_status = $notification['seen'] ? 'Seen' : 'Unseen';
                    echo '<br>Status: ' . $seen_status;
                    echo '</li>';
                }
            } else {
                echo '<li class="list-group-item notification-item">No notifications available.</li>';
            }
            ?>
        </ul>
    </section>

</body>
</html>
