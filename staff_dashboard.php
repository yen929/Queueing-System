<?php
session_start();
include 'db.php';

if (!isset($_SESSION['staff_username'])) {
    header("Location: login.php");
    exit();
}

$staff_username = $_SESSION['staff_username'];
$action_type = strtoupper($_SESSION['action_type']); 

$sql_priority = "SELECT q.queue_number, s.id, s.name, s.course, s.is_pwd
                 FROM queues q
                 JOIN students s ON q.student_id = s.id
                 WHERE q.status='waiting' AND s.is_pwd=1
                 ORDER BY q.id ASC";
$result_priority = mysqli_query($conn, $sql_priority);

$sql_regular = "SELECT q.queue_number, s.id, s.name, s.course, s.is_pwd
                FROM queues q
                JOIN students s ON q.student_id = s.id
                WHERE q.status='waiting' AND s.is_pwd=0
                ORDER BY q.id ASC";
$result_regular = mysqli_query($conn, $sql_regular);

$serve_priority = mysqli_fetch_assoc($result_priority);
$serve_regular = mysqli_fetch_assoc($result_regular);
$student_to_serve = $serve_priority ?: $serve_regular;

$student = null;
if (isset($_GET['student_id'])) {
    $sid = $_GET['student_id'];
    $sql = "SELECT q.queue_number, s.*
            FROM queues q
            JOIN students s ON q.student_id = s.id
            WHERE s.id='$sid' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($res);
}

mysqli_data_seek($result_priority, 0);
mysqli_data_seek($result_regular, 0);
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Dashboard</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f0f2f5;
}

.header {
background: #1e1e2f;
color: #fff;
padding: 15px 30px;
display: flex;
justify-content: space-between;
align-items: center;
font-size: 18px;
}
.header a {
color: #ff6b6b;
font-weight: bold;
text-decoration: none;
}
.header a:hover { text-decoration: underline; }

.container {
display: flex;
height: calc(100vh - 60px);
}

.left {
width: 40%;
background: #fff;
padding: 20px;
overflow-y: auto;
border-right: 3px solid #ddd;
}
h2 { margin-bottom: 15px; color: #222; }

.queue-box { margin-bottom: 30px; }
.queue-item {
display: flex; justify-content: space-between; align-items: center;
background: #f9f9f9;
padding: 12px; border-radius: 8px;
margin: 8px 0;
border-left: 5px solid #1f3b73;
transition: all 0.3s;
}
.queue-item.priority { border-left-color: #d9534f; }
.queue-item:hover { background: #e6e6e6; }
.queue-item span { font-size: 1.1em; font-weight: bold; }

.view-btn {
color: #007bff; font-weight: bold;
text-decoration: none;
display: flex; flex-direction: column; align-items: center;
}
.eye { font-size: 20px; }

.right {
flex: 1;
background: #1e1e2f;
color: #fff;
padding: 30px;
display: flex; justify-content: center; align-items: center;
}
.form-box {
background: #fff; color: #222;
padding: 30px;
border-radius: 12px;
width: 100%; max-width: 500px;
box-shadow: 0 0 15px rgba(0,0,0,0.2);
}
.form-box h2 { margin-bottom: 20px; color: #1e1e2f; }
.form-box p { margin: 10px 0; font-size: 16px; }
.form-box button {
padding: 12px 25px; border: none;
border-radius: 6px; cursor: pointer; font-weight: bold;
margin-right: 10px;
}
.print-btn { background: #28a745; color:white; }
.print-btn:hover { background: #23963c; }
.proceed-btn { background: #007bff; color:white; }
.proceed-btn:hover { background: #0056b3; }

.no-student {
color: #ccc;
font-size: 22px;
text-align: center;
} </style>

</head>
<body>

<div class="header">
    <div>
        Logged in as: <b><?= $staff_username; ?></b> 
        (<b><?= $action_type; ?></b>)
    </div>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="left">
        <div class="queue-box">
            <h2>Priority Queue</h2>
            <?php while($row = mysqli_fetch_assoc($result_priority)) { ?>
                <div class="queue-item priority">
                    <span><?= $row['queue_number']; ?> - <?= $row['name']; ?></span>
                    <?php if ($student_to_serve && $row['id'] == $student_to_serve['id']) { ?>
                        <a class="view-btn" href="staff_dashboard.php?student_id=<?= $row['id']; ?>">
                            <span class="eye">👁</span> View
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

    <div class="queue-box">
        <h2>Regular Queue</h2>
        <?php while($row = mysqli_fetch_assoc($result_regular)) { ?>
            <div class="queue-item">
                <span><?= $row['queue_number']; ?> - <?= $row['name']; ?></span>
                <?php if ($student_to_serve && $row['id'] == $student_to_serve['id']) { ?>
                    <a class="view-btn" href="staff_dashboard.php?student_id=<?= $row['id']; ?>">
                        <span class="eye">👁</span> View
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="right">
    <?php if ($student) { ?>
        <div class="form-box">
            <h2>Enrollment Form</h2>
            <p><b>Name:</b> <?= $student['name']; ?></p>
            <p><b>Course:</b> <?= $student['course']; ?></p>

            <br>
            <button class="print-btn" onclick="window.print()">🖨 Print</button>
            <a href="proceed.php?queue_number=<?= $student['queue_number']; ?>">
                <button class="proceed-btn">➡ Proceed</button>
            </a>
        </div>
    <?php } else { ?>
        <div class="no-student">No student selected</div>
    <?php } ?>
</div>
```

</div>

</body>
</html>
