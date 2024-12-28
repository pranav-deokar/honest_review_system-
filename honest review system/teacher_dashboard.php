<?php
session_start();

if (!isset($_SESSION['teacher_email'])) { 
    header("Location: teacher_login.php");
    exit();
}

include 'db.php';  

$teacher_email = $_SESSION['teacher_email'];
$query = "SELECT * FROM teachers WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $teacher_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$teacher = mysqli_fetch_assoc($result);

if ($teacher) {
    $teacher_name = $teacher['name'];
   
} else {
    echo "Teacher not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="bg-custom text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-white">Welcome, <span id="teacherName"><?php echo $teacher_name; ?></span></h1>
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
                    <li class="nav-item">
                        <a class="nav-link" href="view_feedback.php">View Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications.php">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_account.php">Manage Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activity_log.php">Activity Log</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_stats.php">Statistics</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <i class="fas fa-comments fa-3x mb-3 text-primary"></i>
                        <h3>View Feedback</h3>
                        <p>Review anonymous feedback given by students.</p>
                        <a href="view_feedback.php" class="btn btn-primary">Go to Feedback</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <i class="fas fa-bell fa-3x mb-3 text-warning"></i>
                        <h3>Notifications</h3>
                        <p>Stay updated on recent activity and messages.</p>
                        <a href="notifications.php" class="btn btn-warning">View Notifications</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <i class="fas fa-user-cog fa-3x mb-3 text-success"></i>
                        <h3>Manage Account</h3>
                        <p>Update your profile information and settings.</p>
                        <a href="manage_account.php" class="btn btn-success">Manage Account</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-3x mb-3 text-info"></i>
                        <h3>Statistics</h3>
                        <p>Analyze feedback rating statistics.</p>
                        <a href="teacher_stats.php" class="btn btn-info">View Statistics</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('logoutButton').addEventListener('click', function() {
                if (confirm('Are you sure you want to log out?')) {
                    window.location.href = 'teacher_logout.php';
                }
            });
            const darkModeToggle = document.getElementById('darkModeToggle');
    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
        </script>
    </section>

</body>

</html>
