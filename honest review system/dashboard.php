<?php

session_start();


include('db_connection.php'); 


if (!isset($_SESSION['username'])) {
    echo 'You must be logged in to view this page';
    exit();
}


$username = $_SESSION['username'];
$studentQuery = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($studentQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $studentId = $student['id'];

    
    $feedbackQuery = "SELECT feedback, rating, timestamp FROM feedbacks WHERE student_id = ? ORDER BY timestamp DESC LIMIT 3";
    $stmt = $conn->prepare($feedbackQuery);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $feedbackResult = $stmt->get_result();
    $feedbacks = $feedbackResult->fetch_all(MYSQLI_ASSOC);
} else {
    $feedbacks = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
    </style>
</head>
<body>

<header class="bg-custom text-white p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="text-white">Welcome, <span id="studentName"><?php echo $_SESSION['username']; ?></span></h1>
        <div class="d-flex align-items-center">
            <span class="me-3 text-white">Good <span id="greetingTime">Day</span>!</span>
            <img src="avatar.png" alt="Profile Picture" class="rounded-circle" width="40" height="40">
            <button id="darkModeToggle" class="btn btn-outline-light ms-3">Dark Mode</button>
            <button id="logoutButton" class="btn btn-outline-light ms-3">Logout</button>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="feedback.html">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="complaint.html">Complaint</a></li>
                <li class="nav-item"><a class="nav-link" href="activity.php">Activity</a></li>
                <li class="nav-item"><a class="nav-link" href="rating.php">Rate Reviews</a></li>
            </ul>
        </div>
    </div>
</nav>
<section class="container my-5">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-comment-dots fa-3x mb-3 text-primary"></i>
                    <h3>Submit Feedback</h3>
                    <p>Provide feedback on your faculty anonymously.</p>
                    <a href="feedback.html" class="btn btn-primary">Go to Feedback</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                    <h3>Register Complaint</h3>
                    <p>File a complaint anonymously if you have concerns.</p>
                    <a href="complaint.html" class="btn btn-warning">Go to Complaint</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-bell fa-3x mb-3 text-success"></i>
                    <h3>Recent Activity</h3>
                    <p>Check your recent submissions and updates.</p>
                    <a href="activity.php" class="btn btn-success">View Activity</a>
                </div>
            </div>
        </div>
    </div>

    
   
</section>

<section class="container my-5">
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Your Feedback History</h3>
            <ul id="feedbackHistory" class="list-group">
                <?php
                if (count($feedbacks) > 0) {
                    foreach ($feedbacks as $feedback) {
                        $timestamp = new DateTime($feedback['timestamp']);
                        echo "<li class='list-group-item'>
                                Rating: {$feedback['rating']} | 
                                Feedback: {$feedback['feedback']} | 
                                Date: {$timestamp->format('F j, Y')}
                              </li>";
                    }
                } else {
                    echo "<li class='list-group-item'>No feedback submitted yet.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</section>

<script>
    
    const now = new Date();
    const hours = now.getHours();
    const greetingElement = document.getElementById('greetingTime');
    if (hours < 12) {
        greetingElement.innerText = 'Morning';
    } else if (hours < 18) {
        greetingElement.innerText = 'Afternoon';
    } else {
        greetingElement.innerText = 'Evening';
    }

   
    const darkModeToggle = document.getElementById('darkModeToggle');
    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });

    
    const logoutButton = document.getElementById('logoutButton');
    logoutButton.addEventListener('click', () => {
        window.location.href = 'logout.php'; 
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
