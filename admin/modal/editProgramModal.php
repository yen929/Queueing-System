<?php // editProgramModal.php ?>

<div class="modal fade" id="editProgramModal" tabindex="-1" aria-labelledby="editProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="editProgramModalLabel">Edit Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/programController.php">
                <div class="modal-body">
                    <input type="hidden" id="edit_program_id" name="programID">
                    <div class="mb-3">
                        <label class="form-label">Program Name</label>
                        <input type="text" id="edit_program_name" name="programName" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-sm text-white py-2 px-3" style="background-color:#660B0B;">Update Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editProgramModal = document.getElementById('editProgramModal');
    editProgramModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('edit_program_id').value = button.getAttribute('data-program-id');
        document.getElementById('edit_program_name').value = button.getAttribute('data-program-name');
    });
</script>