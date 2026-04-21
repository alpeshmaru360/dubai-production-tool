document.addEventListener('DOMContentLoaded', function () {
    $('#users_table').DataTable({
        paging: true,
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        columnDefs: [{
            orderable: true,
            targets: [0, 1, 2, 3, 4]
        },
        {
            orderable: false,
            targets: [5]
        } // Adjust if needed
        ]
    });
});

function openEditModal(user) {
    document.getElementById('edit_name').value = user.name;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_phone').value = user.phone;
    document.getElementById('edit_role').value = user.role;

    const countrySelect = document.getElementById('edit_country');
    const countryOption = Array.from(countrySelect.options).find(option => option.textContent === user
        .country_name);
    if (countryOption) {
        countryOption.selected = true;
    }

    document.getElementById('editUserForm').action = `/admin/users/${user.id}`;

    var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editUserModal.show();
}

function openDeleteModal(userId) {
    var deleteForm = document.getElementById('deleteUserForm');
    deleteForm.action = `/admin/users/${userId}`;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    deleteModal.show();
}


// function showToast(message, type = 'success') {
//     Toastify({
//         text: message,
//         duration: 3000,
//         close: true,
//         gravity: "top",
//         position: "right",
//         backgroundColor: type === 'success' ? "#4CAF50" : "#F44336",
//     }).showToast();
// }