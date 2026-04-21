document.getElementById('fileUploadModal').addEventListener('show.bs.modal', function () {
    document.body.style.overflow = 'hidden';
});

// Enable scrolling when modal closes
document.getElementById('fileUploadModal').addEventListener('hidden.bs.modal', function () {
    document.body.style.overflow = '';
});

// // Check if the success message is present
// window.addEventListener('DOMContentLoaded', function () {
//     var successMessage = document.getElementById('successMessage');
//     if (successMessage) {
//         // Hide the success message after 3 seconds (3000 ms)
//         setTimeout(function () {
//             successMessage.style.display = 'none';
//         }, 15000);
//     }
// });

// This script will set the values in the edit modal when the edit button is clicked
var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var id = button.getAttribute('data-id');
    var country = button.getAttribute('data-country');
    var projectName = button.getAttribute('data-project-name');
    var aboutProject = button.getAttribute('data-about-project');
    var productType = button.getAttribute('data-product-type');

    // Set the form action URL to include the project ID
    var form = editModal.querySelector('#editForm');
    var formAction = form.getAttribute('action').replace(':id', id);
    form.setAttribute('action', formAction);

    // Set values in the form fields
    editModal.querySelector('#editCountry').value = country;
    editModal.querySelector('#editProjectName').value = projectName;
    editModal.querySelector('#editAboutProject').value = aboutProject;
    editModal.querySelector('#editProductType').value = productType;
});

// Handle delete confirmation
var deleteConfirmModal = document.getElementById('deleteConfirmModal');
deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var projectId = button.getAttribute('data-project-id');
    var form = deleteConfirmModal.querySelector('#deleteForm');
    var action = form.getAttribute('action').replace(':id', projectId);
    form.setAttribute('action', action);
});

// Handle Read More modal
var readMoreModal = document.getElementById('readMoreModal');
readMoreModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget; // Button that triggered the modal
    var fullText = button.getAttribute('data-full-text');
    var modalBody = readMoreModal.querySelector('.modal-body p');
    modalBody.textContent = fullText;
});