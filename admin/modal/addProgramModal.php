<?php // addProgramModal.php ?>

<div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="addProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="addProgramModalLabel">Add Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="http://localhost/QUEUE-SYS/admin/controller/programController.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="departmentID" class="form-select" required>
                            <option value="" selected disabled>Select department</option>
                            <?php foreach ($dept as $d): ?>
                                <option value="<?= $d['departmentID'] ?>"><?= $d['departmentName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program Name</label>
                        <input type="text" name="programName" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-sm text-white py-2 px-3" style="background-color:#660B0B;">Save Program</button>
                </div>
            </form>
        </div>
    </div>
</div>