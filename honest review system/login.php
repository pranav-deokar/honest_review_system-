<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "honest_review_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['community'] = 'student';

            header("Location: dashboard.php");  
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No such user found!";
    }
}

$conn->close();
?>
