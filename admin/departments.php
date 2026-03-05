<?php
session_start(); 
$active = 'departments'; 

require_once '../config/config.php';

try {
    $conn = new Connection();
    $db = $conn->getConnection();
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Fetch departments
$query = "SELECT * FROM `departments`";
$stmt = $db->query($query);
$dept = $stmt->fetchAll(PDO::FETCH_ASSOC); 

// Fetch programs grouped by dept_id
$progQuery = "SELECT * FROM `programs`";
$progStmt = $db->query($progQuery);
$allPrograms = $progStmt->fetchAll(PDO::FETCH_ASSOC);

// Group programs by dept_id
$programsByDept = [];
foreach ($allPrograms as $program) {
    $programsByDept[$program['departmentID']][] = $program;
}

$query = "SELECT d.*, COUNT(p.programID) AS program_count 
          FROM departments d 
          LEFT JOIN programs p ON d.departmentID = p.departmentID 
          GROUP BY d.departmentID";
$stmt = $db->query($query);
$dept = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departments</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<?php include 'navbar.php'; ?>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
    
    <div class="flex-fill p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Departments</h5>
            <a href="#" role="button" onclick="return false;" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#addDepartmentModal" style="background-color:#630000;">
                <i class="bi bi-plus-circle"></i> Add Department
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th></th>
                                <th>Department ID</th>
                                <th>Department Name</th>
                                <th>Programs</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
    <tbody>
        <?php foreach ($dept as $d): ?>
        <!-- DEPARTMENT ROW -->
        <tr>
            <td>
                <button class="btn btn-sm btn-outline-secondary" type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#programs-<?php echo $d['departmentID']; ?>" 
                    aria-expanded="false">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </td>
            <td><?php echo htmlspecialchars($d['departmentID']); ?></td>
            <td><?php echo htmlspecialchars($d['departmentName']); ?></td>
            <td><?php echo $d['program_count']; ?></td>
            <td>
                <button class="btn btn-sm btn-outline-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#editDepartmentModal"
                    data-department-id="<?php echo $d['departmentID']; ?>"
                    data-department-name="<?php echo $d['departmentName']; ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                <button class="btn btn-sm btn-outline-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteDepartmentModal"
                    data-department-id="<?php echo $d['departmentID']; ?>"
                    data-department-name="<?php echo $d['departmentName']; ?>">
                    <i class="bi bi-trash"></i> Delete
        </tr>

        <!-- EXPANDED PROGRAMS ROW -->
        <tr class="collapse" id="programs-<?php echo $d['departmentID']; ?>">
            <td colspan="5" class="bg-light p-0">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>Programs under <?php echo htmlspecialchars($d['departmentName']); ?></strong>
                        <button class="btn btn-sm text-white" 
                            data-bs-toggle="modal" 
                            data-bs-target="#addProgramModal"
                            data-dept-id="<?php echo $d['departmentID']; ?>"
                            data-dept-name="<?php echo $d['departmentName']; ?>"
                            style="background-color:#630000;">
                            <i class="bi bi-plus-circle"></i> Add Program
                        </button>
                    </div>

                    <?php if (!empty($programsByDept[$d['departmentID']])): ?>
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Program Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programsByDept[$d['departmentID']] as $program): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($program['programName']); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProgramModal"
                                        data-program-id="<?php echo $program['programID']; ?>"
                                        data-program-name="<?php echo $program['programName']; ?>"
                                        data-dept-id="<?php echo $program['departmentID']; ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>   
                                    <button class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteProgramModal"
                                        data-program-id="<?php echo $program['programID']; ?>"
                                        data-program-name="<?php echo $program['programName']; ?>">
                                        <i class="bi bi-trash"></i> Delete
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p class="text-muted mb-0">No programs found for this department.</p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'modal/addDepartmentModal.php'; ?>
<?php include 'modal/editDepartmentModal.php'; ?>
<?php include 'modal/addProgramModal.php'; ?>
<?php include 'modal/editProgramModal.php'; ?>
<?php include 'modal/deleteDepartmentModal.php'; ?>
<?php include 'modal/deleteProgramModal.php'; ?>
<?php include '../common/sucess.php'; ?>
<?php include '../common/error.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    }

    // Toggle chevron icon direction on expand/collapse
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function () {
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-chevron-down');
            icon.classList.toggle('bi-chevron-up');
        });
    });
</script>
</body>
</html>