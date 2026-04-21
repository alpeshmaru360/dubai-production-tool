document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable
    $('#request_training').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [2, 5, 10, 25, 50, 100],
        ordering: false
    });

    // Attach event to dynamically load and show full description in the modal
    document.querySelectorAll('.read-more').forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const fullDescription = this.getAttribute('data-description');
            document.getElementById('fullDescriptionContent').innerText = fullDescription;

            // Initialize and show the modal
            const descriptionModal = new bootstrap.Modal(document.getElementById('descriptionModal'));
            descriptionModal.show();
        });
    });

    // Manually attach click event to close button in case automatic dismiss isn't working
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const descriptionModal = bootstrap.Modal.getInstance(document.getElementById('descriptionModal'));
            descriptionModal.hide();
        });
    });
});