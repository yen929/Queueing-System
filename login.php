<?php
session_start(); 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type']; 

    $sql = "SELECT * FROM useraccount 
        WHERE email='$email' 
        AND password='$password' 
        AND user_type='$type'";

    $result = $conn->query($sql);
    
if (!$result) {
    die("SQL Error: " . $conn->error);
}

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $type;

        if ($type == 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($type == 'faculty') {
            header("Location: faculty/dashboard.php");
        } else {
            header("Location: student/dashboard.php");
        }
        exit();

    } else {
        $_SESSION['error'] = "Invalid login credentials.";
        header("Location: adminLogin.php");
        exit();
    }
}