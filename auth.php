{"id":"50122","title":"Authentication","variant":"standard"}
<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM staff WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $staff = mysqli_fetch_assoc($result);

    if ($staff) {
        if ($password == $staff['password']) {
            $_SESSION['staff_id'] = $staff['id'];
            $_SESSION['staff_role'] = $staff['role'];
            $_SESSION['staff_username'] = $staff['username'];
            header("Location: staff_dashboard.php");
            exit;
        } 
        else {
            header("Location: login.php?error=Incorrect password.");
            exit;
        }
    } 
    else {
        header("Location: login.php?error=Account not found.");
        exit;
    }
}
?>
