<?php

include('db_connection.php');
session_start();


if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

$teacher_id = $_SESSION['teacher_id']; 

$name = $email = $password = "";

$query = "SELECT name, email FROM teachers WHERE teacher_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    if (empty($new_password)) {
        $new_password = $password; 
    } else {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    }

    $update_query = "UPDATE teachers SET name = ?, email = ?, password = ? WHERE teacher_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi", $new_name, $new_email, $new_password, $teacher_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Account details updated successfully'); window.location.href = 'dashboard.php';</script>";
    $activity_description = "Profile updated: Name - $new_name, Email - $new_email";

    $log_query = "INSERT INTO activity_log (teacher_id, activity_description) VALUES (?, ?)";
    $stmt = $conn->prepare($log_query);
    $stmt->bind_param("is", $teacher_id, $activity_description);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_account.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account | Honest Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="bg-custom text-white p-3">
        <div class="container">
            <h2>Manage Account</h2>
        </div>
    </header>

    <section class="container my-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </section>

</body>
</html>
