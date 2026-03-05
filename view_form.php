<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_GET['queue_number'])) {
    $queue_number = $_GET['queue_number'];

    $sql = "SELECT q.queue_number, s.* 
            FROM queues q
            JOIN students s ON q.student_id = s.id
            WHERE q.queue_number = '$queue_number'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Enrollment Form</title>
</head>
<body>
    <h2>Enrollment Form</h2>

    <?php if ($student) { ?>
        <p><b>Queue Number:</b> <?php echo $student['queue_number']; ?></p>
        <p><b>Name:</b> <?php echo $student['name']; ?></p>
        <p><b>Course:</b> <?php echo $student['course']; ?></p>
        <p><b>Special Needs:</b> <?php echo ($student['is_pwd'] == 1) ? 'Yes' : 'No'; ?></p>

        <br><br>
        <button onclick="window.print()">🖨️ Print</button>
        <a href="proceed.php?queue_number=<?php echo $student['queue_number']; ?>">
            <button type="button">➡️ Proceed</button>
        </a>
    <?php } else { ?>
        <p>No record found.</p>
    <?php } ?>
</body>
</html>
