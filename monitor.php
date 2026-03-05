<?php
include 'db.php';
$sql_priority = "SELECT queue_number FROM queues 
                 JOIN students ON queues.student_id = students.id
                 WHERE students.is_pwd = 1 
                 AND queues.stage = 'evaluation' 
                 AND queues.status = 'waiting'
                 ORDER BY queues.id ASC LIMIT 5";
$result_priority = mysqli_query($conn, $sql_priority);
$sql_regular = "SELECT queue_number FROM queues 
                JOIN students ON queues.student_id = students.id
                WHERE students.is_pwd = 0 
                AND queues.stage = 'evaluation' 
                AND queues.status = 'waiting'
                ORDER BY queues.id ASC LIMIT 5";
$result_regular = mysqli_query($conn, $sql_regular);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Counter 1 – Payment </title>
    <meta http-equiv="refresh" content="5">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f0f2f5;
            text-align: center;
        }

        h1 {
            margin-top: 30px;
            font-size: 3.5em;
            color: #003366;
            font-weight: 900;
            letter-spacing: 2px;
        }

        h2 {
            font-size: 2em;
            color: #003366;
            margin-bottom: -10px;
        }

        .container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 50px;
            width: 95%;
        }

        .queue-box {
            flex: 1;
            max-width: 450px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            color: #003366;
            min-height: 450px;
        }

        .queue-title {
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .number {
            display: block;
            margin: 10px 0;
            padding: 20px;
            font-size: 2.8em;
            font-weight: 900;
            color: #0074ff;
            background: #eef3ff;
            border-radius: 15px;
        }

        .active {
            background: #28a745 !important;
            color: white !important;
            animation: blink 1s infinite;
        }

        @keyframes blink { 
            50% { opacity: 0.6; } 
        }

        .note {
            margin-top: 40px;
            font-size: 1.4em;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>

    <h2>Counter 1</h2>
    <h1>Payment</h1>

    <div class="container">
        <div class="queue-box">
            <div class="queue-title">Priority Queue</div>

            <?php 
            $i = 0;
            if (mysqli_num_rows($result_priority) > 0) {
                while($row = mysqli_fetch_assoc($result_priority)) {
                    $i++;
                    echo "<span class='number ".($i == 1 ? "active" : "")."'>".$row['queue_number']."</span>";
                }
            } else {
                echo "<span class='number'>— — —</span>";
            }
            ?>
        </div>

        <div class="queue-box">
            <div class="queue-title">Regular Queue</div>

            <?php 
            $j = 0;
            if (mysqli_num_rows($result_regular) > 0) {
                while($row = mysqli_fetch_assoc($result_regular)) {
                    $j++;
                    $active = ($i == 0 && $j == 1) ? "active" : "";
                    echo "<span class='number $active'>".$row['queue_number']."</span>";
                }
            } else {
                echo "<span class='number'>— — —</span>";
            }
            ?>
        </div>

    </div>

    <div class="note">
        *Please wait for your queue number to appear on screen.*
    </div>

</body>
</html>
