<?php include 'db.php'; ?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Queuing System – Enrollment</title>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

```
body {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #fff;
padding: 35px 30px;
border-radius: 12px;
width: 100%;
max-width: 360px;
box-shadow: 0 8px 20px rgba(0,0,0,0.1);
text-align: center;
}

.enroll-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease;
    text-align: center;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.enroll-container img.logo {
    width: 100px;
    margin-bottom: 15px;
    animation: logoAppear 1s ease forwards;
}

@keyframes logoAppear {
    0% { opacity: 0; transform: scale(0.7); }
    100% { opacity: 1; transform: scale(1); }
}

.enroll-container h2 {
    color: #333;
    margin-bottom: 25px;
    font-weight: 600;
}

form label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
    text-align: left;
}

form input[type="text"],
form input[type="email"],
form input[type="number"] {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: all 0.3s ease;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="number"]:focus {
    border-color: #2575fc;
    box-shadow: 0 0 8px rgba(37,117,252,0.3);
    outline: none;
}

form input[type="radio"],
form input[type="checkbox"] {
    margin-right: 8px;
}

.cert {
    font-size: 13px;
    color: #555;
    margin-top: 15px;
    display: block;
    text-align: left;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

@media (max-width: 480px) {
    .enroll-container {
        padding: 30px 20px;
    }
    button {
        padding: 10px;
        font-size: 15px;
    }
}

</style>
</head>
<body>

<div class="enroll-container">
    <img src="480238644_1079357694230488_4924477017625079411_n (1).jpg" alt="Logo" class="logo">
 <div class="tagline">Nueva Vizcaya State University</div>
<h2>Enrollment Form</h2>

<form method="POST" action="queue.php">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Course:</label>
    <input type="text" name="course" required>

    <label>Choose Queue Type:</label>

    <label>
        <input type="radio" name="queue_type" value="0" checked>
        Regular Student
    </label>

    <label>
        <input type="radio" name="queue_type" value="1">
        Student with Special Needs (PWD, Pregnant, etc.)
    </label>

    <label class="cert">
        <input type="checkbox" required>
        I hereby certify that the above information and all the details I have provided in this enrollment form 
        are true and complete. I fully understand that any false or misleading information may affect my 
        enrollment status.
    </label>

    <button type="submit">Submit</button>
</form>

</div>

</body>
</html>
