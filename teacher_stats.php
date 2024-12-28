<?php
include('db_connection.php');
session_start();
date_default_timezone_set('Asia/Kolkata'); 

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php'); 
    exit();
}

$teacher_id = $_SESSION['teacher_id']; 

$activity_description = "Viewed Rating Statistics";
$timestamp = date('Y-m-d H:i:s'); 

$log_query = "INSERT INTO activity_log (teacher_id, activity_description, timestamp) VALUES (?, ?, ?)";
$stmt = $conn->prepare($log_query);
$stmt->bind_param("iss", $teacher_id, $activity_description, $timestamp);
$stmt->execute();
$stmt->close();

$query = "SELECT name FROM teachers WHERE teacher_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$stmt->bind_result($teacher_name);
$stmt->fetch();
$stmt->close();

$rating_distribution_query = "
    SELECT rating, COUNT(*) as count
    FROM feedbacks
    WHERE teacher_id = ?
    GROUP BY rating";
$stmt = $conn->prepare($rating_distribution_query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$rating_distribution = [];
while ($row = $result->fetch_assoc()) {
    $rating_distribution[(int)$row['rating']] = (int)$row['count'];
}
$stmt->close();

$rating_trends_query = "
    SELECT DATE_FORMAT(timestamp, '%d %b %Y') as day, AVG(rating) as avg_rating
    FROM feedbacks
    WHERE teacher_id = ?
    GROUP BY day
    ORDER BY timestamp ASC";
$stmt = $conn->prepare($rating_trends_query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$rating_trends = [];
while ($row = $result->fetch_assoc()) {
    $rating_trends[] = ['day' => $row['day'], 'avg_rating' => (float)$row['avg_rating']];
}
$stmt->close();

$review_stats_query = "
    SELECT COUNT(*) as num_reviews, MAX(rating) as highest_rating, MIN(rating) as lowest_rating
    FROM feedbacks
    WHERE teacher_id = ?";
$stmt = $conn->prepare($review_stats_query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$stmt->bind_result($num_reviews, $highest_rating, $lowest_rating);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Statistics | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #3a271d;
        }
        .container {
            margin-top: 30px;
            background-color: #fff8e1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2, h4 {
            color: #3a271d;
        }
        .list-group-item {
            background-color: #fff8e1;
            color: #3a271d;
            border: 1px solid #a97c56;
        }
        .chart-container {
            margin-bottom: 30px;
        }
        .chart-column {
            max-width: 100%;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Rating Statistics for Teacher: <strong><?php echo htmlspecialchars($teacher_name); ?></strong></h2>
        <div class="row">
            <div class="col-md-6 chart-column">
                <h4>Overall Ratings Distribution</h4>
                <canvas id="overallRatingsChart"></canvas>
            </div>
            <div class="col-md-6 chart-column">
                <h4>Rating Trends Over Time</h4>
                <canvas id="ratingTrendsChart"></canvas>
            </div>
        </div>
        <div class="mb-5">
            <h4>Review Statistics</h4>
            <ul class="list-group">
                <li class="list-group-item">Number of Reviews: <span id="numReviews"><?php echo $num_reviews; ?></span></li>
                <li class="list-group-item">Highest Rating Given: <span id="highestRating"><?php echo $highest_rating; ?></span></li>
                <li class="list-group-item">Lowest Rating Given: <span id="lowestRating"><?php echo $lowest_rating; ?></span></li>
            </ul>
        </div>
    </div>
    <script>
        const ratingDistribution = <?php echo json_encode($rating_distribution); ?>;
        const ratingTrends = <?php echo json_encode($rating_trends); ?>;

        const overallRatingsData = {
            labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            datasets: [{
                label: 'Percentage of Ratings',
                data: [
                    ratingDistribution[1] || 0,
                    ratingDistribution[2] || 0,
                    ratingDistribution[3] || 0,
                    ratingDistribution[4] || 0,
                    ratingDistribution[5] || 0
                ],
                backgroundColor: ['#ff4c4c', '#ff944c', '#ffd700', '#9acd32', '#4caf50']
            }]
        };
        const overallRatingsConfig = {
            type: 'pie',
            data: overallRatingsData,
            options: { responsive: true, plugins: { legend: { position: 'top' } } }
        };
        new Chart(document.getElementById('overallRatingsChart'), overallRatingsConfig);

        const trendLabels = ratingTrends.map(item => item.day);
        const trendData = ratingTrends.map(item => item.avg_rating);

        const ratingTrendsData = {
            labels: trendLabels,
            datasets: [{
                label: 'Average Rating',
                data: trendData,
                borderColor: '#a97c56',
                backgroundColor: 'rgba(169, 124, 86, 0.2)',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        };

        const ratingTrendsConfig = {
            type: 'line',
            data: ratingTrendsData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        title: {
                            display: true,
                            text: 'Average Rating'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day'
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('ratingTrendsChart'), ratingTrendsConfig);
    </script>
</body>
</html>
