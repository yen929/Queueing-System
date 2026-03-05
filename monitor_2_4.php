<?php
include 'db.php';
$counters = ["payment", "registrar", "other"];
$current = [];

foreach ($counters as $c) {
    $sql = "SELECT queue_number FROM queues 
            WHERE stage = '$c' AND status = 'waiting'
            ORDER BY id ASC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current[$c] = $row ? $row['queue_number'] : "— — —";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Now Serving</title>
    <meta http-equiv="refresh" content="5">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100vh;
        }

        h1 {
            margin-top: 30px;
            font-size: 4em;
            color: #003366;
            font-weight: 900;
            letter-spacing: 3px;
        }

        .container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 50px;
            width: 95%;
        }

        .counter-box {
            flex: 1;
            max-width: 450px;
            height: 350px; 
            background: white;
            padding: 50px 20px;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            color: #003366;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center;
        }

        .counter-title {
            font-size: 2em; 
            font-weight: bold;
            margin-bottom: 25px;
        }

        .queue-number {
            font-size: 6em;
            font-weight: 900;
            color: #0074ff;
            margin-top: 10px;
        }

        .note {
            margin-top: 40px;
            font-size: 1.5em;
            color: #444;
            font-style: italic;
        }
    </style>
</head>

<body>

    <h1>NOW SERVING</h1>

    <div class="container">

        <div class="counter-box">
            <div class="counter-title">Counter 2</div>
            <div class="counter-title">(Evaluation)</div>
            <div class="queue-number"><?php echo $current['payment']; ?></div>
        </div>

        <div class="counter-box">
            <div class="counter-title">Counter 3</div>
            <div class="counter-title">(Enrolled Subject)</div>
            <div class="queue-number"><?php echo $current['registrar']; ?></div>
        </div>

    </div>

    <div class="note">
        *Please wait for your queue number to appear on screen.*
    </div>

</body>
</html>
