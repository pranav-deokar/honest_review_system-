<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo 'You must be logged in to view feedbacks.';
    exit;
}

require_once 'db_connection.php';  

if (isset($_POST['department'])) {
    $department = $_POST['department'];

    $query = "SELECT f.feedback_id, f.teacher_id, f.feedback, f.rating, f.timestamp, t.name AS teacher_name, t.department AS teacher_department
              FROM feedbacks f
              JOIN teachers t ON f.teacher_id = t.teacher_id
              WHERE t.department = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $result = $stmt->get_result();

    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate and Review Feedback</title>
    <style>
        body {
            background-color: #f5f5dc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3a271d;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .review-container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .review-header {
            font-size: 18px;
            font-weight: bold;
            color: #6b5b4a;
            margin-bottom: 10px;
        }

        .review-body {
            font-size: 16px;
            color: #4f4f4f;
            margin-bottom: 20px;
        }

        .feedback-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .feedback-button {
            background-color: #3a271d;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .feedback-button:hover {
            background-color: #2e1f16;
        }

        .comment-section {
            margin-top: 20px;
        }

        .comment-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-button {
            background-color: #3a271d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .comment-button:hover {
            background-color: #2e1f16;
        }

        .view-comments-button {
            background-color: #3a271d;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .view-comments-button:hover {
            background-color: #2e1f16;
        }

        .comment-list {
            display: none;
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }

        .comment {
            background-color: #f0e9dc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #3a271d;
            color: white;
            text-align: center;
        }

        @media (max-width: 768px) {
            .review-container {
                padding: 10px;
            }

            .feedback-button, .comment-button, .view-comments-button {
                padding: 10px;
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    Rate and Review Feedback
</header>

<form method="POST" action="">
    <label for="department">Select Department:</label>
    <select name="department" id="department" required>
        <option value="">--Select Department--</option>
       
        
        <option value="Computer Science">Computer Science</option>
        <option value="Electrical Engineering">Electrical Engineering</option>
        <option value="Mechanical Engineering">Mechanical Engineering</option>
        <option value="Civil Engineering">Civil Engineering</option>
        <option value="Chemical Engineering">Chemical Engineering</option>
        <option value="Aerospace Engineering">Aerospace Engineering</option>
        <option value="Biotechnology Engineering">Biotechnology Engineering</option>
        <option value="Electronics & Communication">Electronics & Communication</option>
        <option value="Information Technology">Information Technology</option>
        <option value="Automobile Engineering">Automobile Engineering</option>
    </select>
    <button type="submit">Fetch Feedbacks</button>
</form>

<div id="reviewsContainer">
    <?php if (isset($feedbacks) && !empty($feedbacks)) : ?>
        <?php foreach ($feedbacks as $index => $review): ?>
            <div class="review-container">
                <div class="review-header">Review #<?php echo $index + 1; ?></div>
                <div><strong>Faculty:</strong> <?php echo htmlspecialchars($review['teacher_name']); ?></div>
                <div><strong>Feedback:</strong> <?php echo htmlspecialchars($review['feedback']); ?></div>
                <div class="feedback-section">
                    <div>
                        <button class="feedback-button" onclick="submitFeedback(<?php echo $review['feedback_id']; ?>, 'true')">True</button>
                        <button class="feedback-button" onclick="submitFeedback(<?php echo $review['feedback_id']; ?>, 'false')">Not True</button>
                    </div>
                    <div>
                        <button class="feedback-button" onclick="submitFeedback(<?php echo $review['feedback_id']; ?>, 'helpful')">Helpful</button>
                        <button class="feedback-button" onclick="submitFeedback(<?php echo $review['feedback_id']; ?>, 'not-helpful')">Not Helpful</button>
                    </div>
                </div>
                <div class="feedback-results" id="feedbackResults-<?php echo $review['feedback_id']; ?>">
                </div>

                <div class="comment-section">
                    <textarea class="comment-input" id="commentInput-<?php echo $review['feedback_id']; ?>" placeholder="Leave a comment..."></textarea>
                    <button class="comment-button" onclick="submitComment(<?php echo $review['feedback_id']; ?>)">Submit Comment</button>
                    <button class="view-comments-button" onclick="toggleComments(<?php echo $review['feedback_id']; ?>)">View Comments</button>
                    <div class="comment-list" id="commentList-<?php echo $review['feedback_id']; ?>">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No feedback available for the selected department.</p>
    <?php endif; ?>
</div>

<footer>
    Honest Review System &copy; 2024
</footer>

<script>
    function submitFeedback(feedbackId, type) {
        const feedbackResults = document.getElementById(`feedbackResults-${feedbackId}`);
        feedbackResults.innerHTML = `<p>Thank you for your feedback! (${type})</p>`;
    }

    let commentsData = {};

    function submitComment(feedbackId) {
        const commentInput = document.getElementById(`commentInput-${feedbackId}`).value;
        if (commentInput.trim() === '') {
            alert('Please enter a comment.');
            return;
        }

        if (!commentsData[feedbackId]) {
            commentsData[feedbackId] = [];
        }
        commentsData[feedbackId].push(commentInput);

        document.getElementById(`commentInput-${feedbackId}`).value = '';

        displayComments(feedbackId, commentsData[feedbackId]);
    }

    function displayComments(feedbackId, comments) {
        const commentList = document.getElementById(`commentList-${feedbackId}`);
        commentList.innerHTML = '';
        comments.forEach(comment => {
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('comment');
            commentDiv.textContent = comment;
            commentList.appendChild(commentDiv);
        });
    }

    function toggleComments(feedbackId) {
        const commentList = document.getElementById(`commentList-${feedbackId}`);
        if (commentList.style.display === 'none' || commentList.style.display === '') {
            commentList.style.display = 'block';
        } else {
            commentList.style.display = 'none';
        }
    }
</script>

</body>
</html>
