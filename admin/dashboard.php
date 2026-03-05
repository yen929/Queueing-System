<?php
$active = 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Dashboard</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  

</head>

<body class="bg-light">
 <?php include 'navbar.php'; ?>
<div class="d-flex">
     <?php include 'sidebar.php'; ?>
<div class="flex-fill p-3">

    <h5 class="mb-2">Welcome, Admin</h5>
    <p class="text-muted mb-3">Enrollment Overview</p>

    <div class="row g-2 
                row-cols-1 
                row-cols-sm-2 
                row-cols-md-3 
                row-cols-lg-5">

        <!-- TOTAL -->
        <div class="col">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body p-2">
                    <i class="bi bi-people-fill fs-4 text-primary"></i>
                    <div class="small mt-1">Total</div>
                    <div class="fw-bold fs-5">1,250</div>
                </div>
            </div>
        </div>

        <!-- BSCS -->
        <div class="col">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body p-2">
                    <i class="bi bi-laptop-fill fs-4 text-success"></i>
                    <div class="small mt-1">BSCS</div>
                    <div class="fw-bold fs-5">320</div>
                </div>
            </div>
        </div>

        <!-- BSIT -->
        <div class="col">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body p-2">
                    <i class="bi bi-pc-display fs-4 text-warning"></i>
                    <div class="small mt-1">BSIT</div>
                    <div class="fw-bold fs-5">410</div>
                </div>
            </div>
        </div>

        <!-- BSINTE -->
        <div class="col">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body p-2">
                    <i class="bi bi-gear-fill fs-4 text-info"></i>
                    <div class="small mt-1">BSINTE</div>
                    <div class="fw-bold fs-5">280</div>
                </div>
            </div>
        </div>

        <!-- BSHM -->
        <div class="col">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body p-2">
                    <i class="bi bi-building fs-4 text-danger"></i>
                    <div class="small mt-1">BSHM</div>
                    <div class="fw-bold fs-5">240</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Students Enrolled -->
 <div class="card shadow-sm mt-4">
    <div class="card-header fw-bold">
        Currently Enrolled Students
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Course</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-001</td>
                        <td>Dela Cruz</td>
                        <td>Juan</td>
                        <td>BSIT</td>
                        <td>3rd Year</td>
                    </tr>
                    <tr>
                        <td>2023-002</td>
                        <td>Santos</td>
                        <td>Maria</td>
                        <td>BSCS</td>
                        <td>2nd Year</td>
                    </tr>
                    <tr>
                        <td>2023-003</td>
                        <td>Reyes</td>
                        <td>Paolo</td>
                        <td>BSINTE</td>
                        <td>4th Year</td>
                    </tr>
                    <tr>
                        <td>2023-004</td>
                        <td>Garcia</td>
                        <td>Ana</td>
                        <td>BSHM</td>
                        <td>1st Year</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('show');
    } else {
        sidebar.classList.toggle('collapsed');
    }

}

</script>


</body>
</html>
