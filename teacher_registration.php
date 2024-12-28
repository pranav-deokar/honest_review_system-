<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "honest_review_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $department = $_POST['department'];
    $teacher_id = $_POST['teacher-id'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO teachers (name, email, password, department, teacher_id)
            VALUES ('$name', '$email', '$hashed_password', '$department', '$teacher_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: teacher_login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
