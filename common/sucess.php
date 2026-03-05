<?php
// Check if the success message is set in the session
if (isset($_SESSION['success'])):
?>

<!-- Success Modal -->
<div class="modal fade" id="globalSuccessModal" tabindex="-1" aria-labelledby="globalSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#660B0B;">
                <h5 class="modal-title text-white" id="globalSuccessModalLabel">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Auto-trigger the modal on page load -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('globalSuccessModal'));
        successModal.show();
    });
</script>

<?php endif; ?>