<?php // deleteDepartmentModal.php ?>

<div class="modal fade" id="deleteDepartmentModal" tabindex="-1" aria-labelledby="deleteDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="deleteDepartmentModalLabel">Delete Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the department <strong id="departmentNameToDelete"></strong>?</p>
                <div class="alert alert-danger p-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Warning:</strong> All programs under this department will also be permanently deleted. This action cannot be undone.
                </div>
                <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/departmentController.php">
                    <input type="hidden" name="departmentID" id="departmentIDToDelete">
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary btn-sm py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-sm text-white py-2 px-3" style="background-color:#660B0B;">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteDepartmentModal = document.getElementById('deleteDepartmentModal');
    deleteDepartmentModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('departmentIDToDelete').value = button.getAttribute('data-department-id');
        document.getElementById('departmentNameToDelete').textContent = button.getAttribute('data-department-name');
    });
</script>