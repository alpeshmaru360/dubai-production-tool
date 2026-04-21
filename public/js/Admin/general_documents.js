document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const chooseFilesButton = document.getElementById('chooseFilesButton');
    const uploadButton = document.getElementById('uploadButton');
    const modalErrorMessages = document.getElementById('modalErrorMessages');
    const modalErrorList = document.getElementById('modalErrorList');
    const fileCountDisplay = document.getElementById('fileCount');
    const fileUploadForm = document.getElementById('fileUploadForm');
    const fileUploadModal = document.getElementById('fileUploadModal');

    const maxFileSize = 15 * 1024 * 1024; // 15 MB limit


    // Initialize DataTable with sorting enabled
    $('#document-table').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [2, 5, 10, 25, 50, 100],
        ordering: true, // Enable sorting
        columnDefs: [
            {
                targets: [0], // You can specify which columns should be sorted. Here, the 1st column is set.
                orderable: true
            },
            {
                targets: [4], // Disable sorting on certain columns if needed
                orderable: false
            }
        ]
    });

    // File validation logic
    fileInput.addEventListener('change', function (event) {
        const files = event.target.files;
        let hasLargeFile = false;
        modalErrorList.innerHTML = ''; // Clear previous errors
        modalErrorMessages.classList.add('d-none'); // Hide error message

        for (const file of files) {
            if (file.size > maxFileSize) {
                hasLargeFile = true;
                const errorItem = document.createElement('li');
                errorItem.textContent = `${file.name} exceeds the 15 MB limit.`;
                modalErrorList.appendChild(errorItem);
            }
        }

        if (hasLargeFile) {
            uploadButton.disabled = true; // Disable upload button
            modalErrorMessages.classList.remove('d-none'); // Show error message
        } else {
            uploadButton.disabled = false; // Enable upload button
            modalErrorMessages.classList.add('d-none'); // Hide error message
        }

        // Update file count display
        fileCountDisplay.textContent = `${files.length} file(s) selected for upload`;
    });

    // Reset form when the modal is closed
    fileUploadModal.addEventListener('hidden.bs.modal', function () {
        // Reset the form fields
        fileUploadForm.reset();

        // Clear file input value
        fileInput.value = '';

        // Clear file count display
        fileCountDisplay.textContent = '';

        // Hide error messages
        modalErrorMessages.classList.add('d-none');
        modalErrorList.innerHTML = '';

        // Disable upload button
        uploadButton.disabled = true;
    });

    // Trigger file input click when the "Choose Files" button is clicked
    chooseFilesButton.addEventListener('click', function () {
        fileInput.click(); // Open the file input dialog
    });
});
