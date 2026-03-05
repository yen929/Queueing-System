<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
$sql_priority = "SELECT q.queue_number, s.name, s.course 
                 FROM queues q 
                 JOIN students s ON q.student_id = s.id 
                 WHERE s.is_pwd = 1 AND q.status = 'waiting'
                 ORDER BY q.id ASC";

$sql_regular = "SELECT q.queue_number, s.name, s.course 
                FROM queues q 
                JOIN students s ON q.student_id = s.id 
                WHERE s.is_pwd = 0 AND q.status = 'waiting'
                ORDER BY q.id ASC";

$result_priority = mysqli_query($conn, $sql_priority);
$result_regular = mysqli_query($conn, $sql_regular);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard - Smart Queuing System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Staff Dashboard</h2>

    <h3>Priority Queue (PWD, Pregnant, etc.)</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Queue Number</th>
            <th>Name</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result_priority)) { ?>
        <tr>
            <td><?php echo $row['queue_number']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><a href="update_status.php?queue_number=<?php echo $row['queue_number']; ?>">Mark as Done</a></td>
        </tr>
        <?php } ?>
    </table>

    <h3>Regular Queue</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Queue Number</th>
            <th>Name</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result_regular)) { ?>
        <tr>
            <td><?php echo $row['queue_number']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><a href="update_status.php?queue_number=<?php echo $row['queue_number']; ?>">Mark as Done</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
