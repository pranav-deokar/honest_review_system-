<?php
function authenticate_teacher($email, $password, $conn) {
    
    $sql = "SELECT teacher_id, password FROM teachers WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    
    $stmt->bind_result($teacher_id, $hashed_password);

    if ($stmt->fetch()) {
       
        if (password_verify($password, $hashed_password)) {
            $stmt->close();
            return $teacher_id; 
        } else {
            $stmt->close();
            return false;
        }
    }

 
    $stmt->close();
    return false; 
}
?>
