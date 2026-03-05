<?php
session_start();
include 'db.php';

// Ensure staff is logged in
if (!isset($_SESSION['staff_username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['queue_number'])) {
    $queue_number = $_GET['queue_number'];

    // 1. Get current stage
    $sql = "SELECT stage FROM queues WHERE queue_number = '$queue_number' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        die("Queue number not found.");
    }
    $row = mysqli_fetch_assoc($result);
    $current_stage = $row['stage'];

    // 2. Determine next stage
    $stages = ['evaluation', 'payment', 'enrolled subj', 'other', 'done'];
    $next_stage = 'done'; // default
    $current_index = array_search($current_stage, $stages);
    if ($current_index !== false && $current_index < count($stages) - 1) {
        $next_stage = $stages[$current_index + 1];
    }

    // 3. Update only this student's queue
    $sql_update_queue = "UPDATE queues 
                         SET stage='$next_stage', status='waiting' 
                         WHERE queue_number='$queue_number'";
    mysqli_query($conn, $sql_update_queue);

    // 4. Update monitors (for this student only)
    $sql_update_monitor1 = "UPDATE monitor_1 
                            SET stage='$next_stage', status='waiting' 
                            WHERE queue_number='$queue_number'";
    mysqli_query($conn, $sql_update_monitor1);

    $sql_update_monitor2_4 = "UPDATE monitor_2_4 
                              SET stage='$next_stage', status='waiting' 
                              WHERE queue_number='$queue_number'";
    mysqli_query($conn, $sql_update_monitor2_4);

    // 5. Get next student for this admin (priority first)
    $admin_stage = $current_stage; // the admin continues serving the same stage
    $sql_next = "SELECT q.student_id 
                 FROM queues q
                 JOIN students s ON q.student_id = s.id
                 WHERE q.status='waiting' AND q.stage='$admin_stage'
                 ORDER BY s.is_pwd DESC, q.id ASC
                 LIMIT 1";
    $res_next = mysqli_query($conn, $sql_next);

    if ($res_next && mysqli_num_rows($res_next) > 0) {
        $next = mysqli_fetch_assoc($res_next);
        $next_id = $next['student_id'];
        // Redirect with next student auto-selected
        header("Location: staff_dashboard.php?student_id=$next_id");
        exit();
    } else {
        // No more students in this stage
        echo "<h3>Queue $queue_number moved to next stage: $next_stage</h3>";
        echo '<a href="staff_dashboard.php">⬅️ Back to Dashboard</a>';
        exit();
    }
}
?>
