<?php
session_start();
include 'db.php';  

if (!isset($_SESSION['teacher_id'])) {
    echo "Teacher ID is not set in session";  
    exit;
}

$teacher_id = $_SESSION['teacher_id'];  

echo "Teacher ID: " . $teacher_id . "<br>";

$sql = "SELECT feedbacks.feedback, feedbacks.rating
        FROM feedbacks
        WHERE feedbacks.teacher_id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Query preparation failed: " . $conn->error;
    exit;
}

$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

echo "Number of feedbacks: " . count($feedbacks) . "<br>";


$activity_query = "INSERT INTO activity_log (teacher_id, activity_description) VALUES (?, ?)";
$activity_stmt = $conn->prepare($activity_query);
$activity_message = "Viewed latest feedbacks";  
$activity_stmt->bind_param("is", $teacher_id, $activity_message);
$activity_stmt->execute();
$activity_stmt->close();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .feedback-card {
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feedback-header {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .feedback-body {
            font-size: 1rem;
            color: #555;
        }
        .rating {
            font-size: 1.1rem;
            color: #f39c12;
        }
        .no-feedback {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #7f8c8d;
        }
        @media (max-width: 576px) {
            .feedback-card {
                margin-left: 10px;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>

    <header class="bg-custom text-white p-3">
        <div class="container">
            <h2>View Feedback</h2>
        </div>
    </header>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div id="feedbackList">
                    <?php if (!empty($feedbacks)): ?>
                        <?php foreach ($feedbacks as $feedback): ?>
                            <div class="feedback-card card p-3 bg-light">
                                <div class="card-body">
                                    <div class="rating">Rating: <?= $feedback['rating'] ?> / 5</div>
                                    <p class="feedback-body mt-2"><?= htmlspecialchars($feedback['feedback']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-feedback">No feedback available.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
