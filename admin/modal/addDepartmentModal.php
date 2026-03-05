<?php // addDepartmentModal.php ?>

<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="addDepartmentModalLabel">Add Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/departmentController.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="departmentName" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-sm text-white py-2 px-3" style="background-color:#660B0B;">Save Department</button>
                </div>
            </form>
        </div>
    </div>
</div>