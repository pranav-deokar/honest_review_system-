<?php
session_start();


if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit;
}


include('db_connection.php'); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_SESSION['username'];


$query = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
   
    die('Error preparing statement: ' . $conn->error);
}

$stmt->bind_param("s", $username);  
$stmt->execute();  
$stmt->bind_result($student_id);  
$stmt->fetch();  

$stmt->close();  

if (!$student_id) {
   
    echo "Student not found.";
    exit;
}


$query = "SELECT teacher_id, feedback_id, feedback, rating, timestamp FROM feedbacks WHERE student_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($query);

if ($stmt === false) {
  
    die('Error preparing statement: ' . $conn->error);
}

$stmt->bind_param("i", $student_id); 
$stmt->execute();  
$result = $stmt->get_result(); 

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;  
}

$stmt->close(); 
$conn->close();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Activity | Honest Review System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5dc;
            color: #3a271d; 
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3a271d; 
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #a97c56;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex; 
            justify-content: center; 
        }

        nav ul li {
            margin: 0 15px; 
        }

        nav ul li a {
            color: #ffffff; 
            text-decoration: none;
            padding: 10px 15px; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
        }

        nav ul li a:hover {
            background-color: #3a271d;
            color: #ffffff;
        }

        section {
            padding: 20px;
        }

        .filter {
            margin-bottom: 20px;
        }

        .filter select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .activity-list {
            list-style-type: none;
            padding: 0;
        }

        .activity-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .activity-item h3 {
            margin: 0 0 10px;
            color: #3a271d; 
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #3a271d;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }

       
        @media (max-width: 600px) {
            nav ul {
                flex-direction: column; 
            }

            nav ul li {
                margin: 5px 0; 
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Recent Activity</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="feedback.php">Submit Feedback</a></li>
                
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Recent Feedbacks</h2>
        <ul class="activity-list" id="activity-list">
            <?php if (empty($feedbacks)): ?>
                <li class="activity-item">No recent feedbacks found.</li>
            <?php else: ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <li class="activity-item">
                        <h3>You submitted feedback</h3>
                        <p><em>Teacher ID:</em> <?= htmlspecialchars($feedback['teacher_id']); ?></p>
                        <p><em>Feedback ID:</em> <?= htmlspecialchars($feedback['feedback_id']); ?></p>
                        <p><em>Feedback:</em> <?= htmlspecialchars($feedback['feedback']); ?></p>
                        <p><em>Rating:</em> <?= htmlspecialchars($feedback['rating']); ?> stars</p>
                        <p><em>Date:</em> <?= date("F j, Y, g:i a", strtotime($feedback['timestamp'])); ?></p>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
    
    <footer>
        <p>&copy; 2024 Honest Review System. All Rights Reserved.</p>
    </footer>
</body>
</html>
