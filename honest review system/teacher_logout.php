<?php
session_start();
session_unset();  
session_destroy(); 
header("Location: teacher_login.php");  
exit;
?>
