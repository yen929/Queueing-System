<?php
session_start();

if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'admin') {
        header('Location: admin/dashboard.php');
    } elseif ($_SESSION['type'] === 'faculty') {
        header('Location: faculty/dashboard.php');
    } elseif ($_SESSION['type'] === 'student') {
        header('Location: student/dashboard.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Login</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark px-4" style="background-color: #630000;">
    <span class="navbar-brand">Queueing System</span>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-5 shadow">

                <!-- CARD HEADER -->
                <div class="card-header text-white fw-bold" style="background-color: #630000;">
                    <i class="bi bi-person-circle me-2"></i> System Login
                </div>

                <div class="card-body">

                    <!-- STEP 1: LOGIN FORM -->
                    <div id="loginForm">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="type" class="form-label">Login As</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="faculty">Faculty</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="mb-3" id="emailField">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3" id="passwordField">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn w-100 text-white" id="loginBtn" style="background-color: #630000;">
                                <i class="bi"></i> Login
                            </button>
                        </form>
                    </div>

                    <!-- STEP 2: STUDENT TYPE SELECTION -->
                    <div id="studentTypeForm" style="display:none;">
                        <p class="text-muted text-center mb-3">Are you a new or returning student?</p>
                        <div class="d-grid gap-2">
                            <button class="btn text-white" id="oldStudentBtn" style="background-color: #630000;">
                                <i class="bi bi-person-check me-2"></i> Old Student
                            </button>
                            <button class="btn btn-outline-secondary" id="newStudentBtn">
                                <i class="bi bi-person-plus me-2"></i> New Student
                            </button>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-link p-0 text-decoration-none text-secondary" id="backBtn">
                                <i class="bi bi-arrow-left"></i> Back
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: OLD STUDENT - ID NUMBER FORM -->
                    <div id="oldStudentForm" style="display:none;">
                        <p class="text-muted text-center mb-3">Enter your Student ID Number to proceed.</p>
                        <form method="POST" action="student/enrollmentForm.php">
                            <div class="mb-3">
                                <label class="form-label">Student ID Number</label>
                                <input type="text" class="form-control" name="student_id" placeholder="e.g. 2023-0001" required>
                            </div>
                            <button type="submit" class="btn w-100 text-white" style="background-color: #630000;">
                                <i class="bi bi-file-earmark-text me-2"></i> Proceed to Enrollment Form
                            </button>
                        </form>
                        <div class="mt-3">
                            <button class="btn btn-link p-0 text-decoration-none text-secondary" id="backFromOldBtn">
                                <i class="bi bi-arrow-left"></i> Back
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const typeSelect = document.getElementById('type');
    const loginForm = document.getElementById('loginForm');
    const studentTypeForm = document.getElementById('studentTypeForm');
    const oldStudentForm = document.getElementById('oldStudentForm');
    const emailField = document.getElementById('emailField');
    const passwordField = document.getElementById('passwordField');
    const loginBtn = document.getElementById('loginBtn');

    // When role is selected
    typeSelect.addEventListener('change', function () {
        if (this.value === 'student') {
            emailField.style.display = 'none';
            passwordField.style.display = 'none';
            loginBtn.style.display = 'none';
            setTimeout(() => {
                loginForm.style.display = 'none';
                studentTypeForm.style.display = 'block';
            }, 300);
        } else {
            emailField.style.display = 'block';
            passwordField.style.display = 'block';
            loginBtn.style.display = 'block';
        }
    });

    // Old Student clicked
    document.getElementById('oldStudentBtn').addEventListener('click', function () {
        studentTypeForm.style.display = 'none';
        oldStudentForm.style.display = 'block';
    });

    // New Student clicked
    document.getElementById('newStudentBtn').addEventListener('click', function () {
        window.location.href = 'student/studentInformationSheet.php';
    });

    // Back to login from student type
    document.getElementById('backBtn').addEventListener('click', function () {
        studentTypeForm.style.display = 'none';
        loginForm.style.display = 'block';
        emailField.style.display = 'block';
        passwordField.style.display = 'block';
        loginBtn.style.display = 'block';
        typeSelect.value = '';
    });

    // Back to student type from old student form
    document.getElementById('backFromOldBtn').addEventListener('click', function () {
        oldStudentForm.style.display = 'none';
        studentTypeForm.style.display = 'block';
    });
</script>

</body>
</html>