<?php // deleteProgramModal.php ?>

<div class="modal fade" id="deleteProgramModal" tabindex="-1" aria-labelledby="deleteProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="deleteProgramModalLabel">Delete Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the program <strong id="programNameToDelete"></strong>?</p>
                <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/programController.php" class="d-inline">
                    <input type="hidden" name="programID" id="programIDToDelete">
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
    const deleteProgramModal = document.getElementById('deleteProgramModal');
    deleteProgramModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('programIDToDelete').value = button.getAttribute('data-program-id');
        document.getElementById('programNameToDelete').textContent = button.getAttribute('data-program-name');
    });
</script>