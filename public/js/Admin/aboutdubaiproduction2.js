function showMessage(message, type = 'success') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

        // Insert the alert at the top of the content
        const content = document.querySelector('.content-wrapper') || document.body;
        content.insertAdjacentElement('afterbegin', alertDiv);

        // Log the message for debugging
        console.log(`Message displayed: ${message}`);
    }

    // Existing code for DataTable initialization
    document.addEventListener('DOMContentLoaded', function() {
        $('#team_table').DataTable({
            paging: true,
            pageLength: 10,
            lengthMenu: [2, 5, 10, 25, 50, 100],
            ordering: false
        });
    });

    // Existing code for image preview
    function previewImage(event, targetId = 'profilePicPreview') {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById(targetId).src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Existing code for image preview while add
    function previewImage_add(event, targetId = 'profilePicPreview_add') {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById(targetId).src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Updated code for edit form submission
    document.getElementById('editMemberForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const action = this.getAttribute('action');

        axios.post(action, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Update response:', response.data);
                if (response.data.success) {
                    // showMessage(response.data.message);
                    $('#editMemberModal').modal('hide');
                    window.location.reload();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showMessage(response.data.message || 'Error updating member', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred while updating the member', 'danger');
            });
    });

    // Existing code for fetching member data
    function fetchMember(id) {
        console.log('Fetching member with ID:', id);
        const baseUrl = window.location.origin;

        axios.get(`${baseUrl}/admin/about-dubai/${id}/edit`)
            .then(response => {
                console.log('Received data:', response.data);
                const data = response.data;

                if (!data) {
                    throw new Error('No data received');
                }

                document.getElementById('editName').value = data.name || '';
                document.getElementById('editDesignation').value = data.designation || '';
                document.getElementById('editEmail').value = data.email || '';

                // Update profile picture preview
                const profilePicPreview = document.getElementById('editProfilePicPreview');
                if (data.profile_pic) {
                    const imageUrl = `${baseUrl}/public/sales_manager/team_about_dubai/${data.profile_pic}`;
                    console.log('Profile pic URL:', imageUrl);
                    profilePicPreview.src = imageUrl;
                } else {
                    profilePicPreview.src = 'https://via.placeholder.com/150';
                }

                // Add error handling for image loading
                profilePicPreview.onerror = function() {
                    console.error('Failed to load profile picture');
                    this.src = 'https://via.placeholder.com/150';
                };

                document.getElementById('editMemberForm').action = `${baseUrl}/admin/about-dubai/${id}`;
            })
            .catch(error => {
                console.error('Error:', error.response ? error.response.data : error.message);
                showMessage('Failed to fetch member data. Please try again.', 'danger');
            });
    }

    // Updated code for delete confirmation
    function confirmDelete(id) {
        const modal = new bootstrap.Modal(document.getElementById('deleteMemberModal'));
        const form = document.getElementById('deleteMemberForm');
        form.action = `${window.location.origin}/admin/about-dubai/${id}`;
        modal.show();
    }

    // Updated code for delete form submission
    document.getElementById('deleteMemberForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        axios.delete(form.action, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                debugger;
                console.log('Delete response:', response.data);
                if (response.data.success) {
                    // showMessage(response.data.message);
                    $('#deleteMemberModal').modal('hide');
                    window.location.reload();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showMessage(response.data.message || 'Error deleting member', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred while deleting the member', 'danger');
            });
    });