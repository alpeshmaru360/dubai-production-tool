document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    const deleteForm = document.getElementById('deleteDocumentForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const documentId = this.getAttribute('data-document-id');
            const deleteUrl = `/admin/media_videos/${documentId}`;
            deleteForm.action = deleteUrl;
            deleteConfirmModal.show();
        });
    });
});
deleteForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const documentId = this.action.split('/').pop();

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            deleteConfirmModal.hide();
            ajaxAlert.classList.remove('alert-success', 'alert-danger');
            ajaxAlert.classList.add(data.success ? 'alert-success' : 'alert-danger');
            ajaxAlertMessage.textContent = data.message;
            ajaxAlert.style.display = 'block';
            ajaxAlert.classList.add('show');

            if (data.success) {
                // Remove the deleted row from the table
                const deletedRow = document.querySelector(`button[data-document-id="${documentId}"]`).closest('tr');
                if (deletedRow) {
                    deletedRow.remove();
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            deleteConfirmModal.hide();
            ajaxAlert.classList.remove('alert-success', 'alert-danger');
            ajaxAlert.classList.add('alert-danger');
            ajaxAlertMessage.textContent = 'An error occurred while deleting the document. Please try again.';
            ajaxAlert.style.display = 'block';
            ajaxAlert.classList.add('show');
        });
});

// Auto-hide alert after 5 seconds
ajaxAlert.addEventListener('shown.bs.alert', function () {
    setTimeout(() => {
        bootstrap.Alert.getOrCreateInstance(ajaxAlert).close();
    }, 5000);
});