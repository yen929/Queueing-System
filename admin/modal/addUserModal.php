<?php
// addUserModal.php
/*
 * addUserModal.php
 * Description: addUserModal for adding user accounts to the system.
 * Author: Charlene B. Dela Cruz
 * Date Created: February 2025
 */
?>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="addUserModalLabel">
                    Add User Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- FORM -->
            <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/userController.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User Type</label>
                        <select name="user_type" class="form-select" required>
                            <option value="" selected disabled>Select user type</option>
                            <option value="Admin">Admin</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm py-2 px-3" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" name="add" class="btn btn-sm text-white py-2 px-3" style="background-color:#660B0B;">
    Save User
</button>
                </div>

            </form>

        </div>
    </div>
</div>
