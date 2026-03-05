<?php
session_start(); 
$active = 'users'; 

require_once '../config/config.php';

try {
    $conn = new Connection();
    $db = $conn->getConnection();
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
$query = "SELECT * FROM `useraccount` ";
$stmt = $db->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Accounts</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<?php include 'navbar.php'; ?>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
    
    <!-- MAIN CONTENT -->
    <div class="flex-fill p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">User Accounts</h5>
            <a href="#" role="button" onclick="return false;" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#addUserModal" style="background-color:#630000;">
                <i class="bi bi-plus-circle"></i> Add User Account
            </a>
        </div>

        <!-- USER TABLE -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>User Type</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($users as $user):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['user_type']); ?></td>
                                <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $user['status'] == 'Active' ? 'success' : 'danger'; ?>">
                                        <?php echo htmlspecialchars($user['status']); ?>
                                    </span>
                                </td>
                                <td>
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                        data-user-id="<?php echo $user['userID']; ?>"
                                        data-user-type="<?php echo $user['user_type']; ?>"
                                        data-first-name="<?php echo $user['first_name']; ?>"
                                        data-last-name="<?php echo $user['last_name']; ?>"
                                        data-email="<?php echo $user['email']; ?>"
                                        data-status="<?php echo $user['status']; ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
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

<?php include 'modal/addUserModal.php'; ?>
<?php include 'modal/editUserModal.php'; ?>
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
</script>

</body>
</html>