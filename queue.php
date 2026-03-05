<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $queue_type = $_POST['queue_type'];

    $sql = "INSERT INTO students (name, course, is_pwd) VALUES ('$name', '$course', '$queue_type')";
    if (mysqli_query($conn, $sql)) {
        $student_id = mysqli_insert_id($conn);
        $queue_number = "Q" . str_pad($student_id, 4, "0", STR_PAD_LEFT);
        $stage = "evaluation"; 
        $status = "waiting";

        $sql2 = "INSERT INTO queues (student_id, queue_number, status, stage) 
                 VALUES ('$student_id', '$queue_number', '$status', '$stage')";
        mysqli_query($conn, $sql2);
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Queue Confirmation</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: #fff;
        text-align: center;
        overflow: hidden;
    }

```
.queue-container {
    background: rgba(255,255,255,0.1);
    padding: 40px 30px;
    border-radius: 15px;
    max-width: 450px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    animation: fadeIn 1s ease;
    position: relative;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.queue-number {
    font-size: 60px;
    font-weight: 700;
    color: #fff;
    margin: 20px 0;
    animation: bounce 1s ease forwards, pop 0.8s ease;
    position: relative;
}

@keyframes pop {
    0% { transform: scale(0.5); opacity: 0; }
    50% { transform: scale(1.3); opacity: 1; }
    100% { transform: scale(1); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-20px); }
    60% { transform: translateY(-10px); }
}

.queue-type {
    font-size: 18px;
    margin-top: 10px;
}

.success-msg {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
}

.confetti {
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: #fff;
    opacity: 0.8;
    top: 0;
    left: 50%;
    animation: confettiFall linear infinite;
}

@keyframes confettiFall {
    0% { transform: translateX(0) translateY(0) rotate(0deg); }
    100% { transform: translateX(calc(-50vw + 100px)) translateY(100vh) rotate(360deg); }
}
```

</style>
</head>
<body>

<div class="queue-container">
    <div class="success-msg">🎉 Enrollment Successful! 🎉</div>
    <div>Your Queue Number:</div>
    <div class="queue-number"><?php echo $queue_number; ?></div>
    <div class="queue-type">
        <?php echo ($queue_type == 1) ? "You are in the <b>Priority Queue</b>." : "You are in the <b>Regular Queue</b>."; ?>
    </div>

<!-- Confetti elements -->
<?php for($i=0; $i<50; $i++): ?>
    <div class="confetti" style="left: <?php echo rand(0, 100); ?>%; background-color: hsl(<?php echo rand(0,360); ?>, 70%, 60%); width: <?php echo rand(5,10); ?>px; height: <?php echo rand(5,10); ?>px; animation-duration: <?php echo rand(2,5); ?>s; animation-delay: <?php echo rand(0,2); ?>s;"></div>
<?php endfor; ?>


</div>

</body>
</html>
