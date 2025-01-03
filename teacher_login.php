<?php
session_start();
include 'db.php';  
include 'functions.php';  


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

     
    $teacher_id = authenticate_teacher($email, $password, $conn);

    if ($teacher_id) {
        
        $_SESSION['teacher_email'] = $email;
        $_SESSION['teacher_id'] = $teacher_id; 

        header("Location: teacher_dashboard.php"); 
        exit;
    } else {
        $error_message = "Invalid email or password!";
    }
}





$activity_query = "INSERT INTO activity_log (teacher_id, activity_description) VALUES (?, ?)";
$activity_stmt = $conn->prepare($activity_query);
$activity_message = "Logged in at " . date('h:i A');  
$activity_stmt->bind_param("is", $teacher_id, $activity_message);
$activity_stmt->execute();
$activity_stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Honest Review System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/retrosupply-jLwVAUtLOAQ-unsplash.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(242, 216, 198, 0.1); 
            border-radius: 10px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
            text-align: center;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #3a271d;
        }
        p {
            color: #555;
            font-size: 16px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            font-size: 14px;
            color: #3a271d;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-button {
            background-color: #a97c56;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
        .login-button:hover {
            background-color: #8B5E3C;
        }
        .image-section {
            margin-bottom: 20px;
        }
        .image-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .register-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        .register-link a {
            color: #a97c56;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
        <h1>Teacher Login</h1>
        <form action="teacher_login.php" method="POST">
            <?php if (isset($error_message)): ?>
                <div class="error"><?= $error_message ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="teacher_registration.html">Register Here</a></p>
        </div>
    </div>

</body>
</html>
