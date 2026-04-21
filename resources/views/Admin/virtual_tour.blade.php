@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/users.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/about_dubai_production_tool.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<section class="p-4">
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="successToast" class="toast align-items-center text-bg-success border border-3 border-white shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fa fa-check-circle me-2 fs-4"></i> <!-- Add a success icon -->
                    <span class="fw-bold fs-5">
                        {{ session('success') }}
                    </span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="heading">Virtual Tour</div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mt-4" id="virtualTourTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="banner-tab" data-bs-toggle="tab" data-bs-target="#banner" type="button" role="tab" aria-controls="banner" aria-selected="true">Banner</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="virtualTourTabsContent">
        <!-- Banner Tab -->
        <div class="tab-pane fade show active" id="banner" role="tabpanel" aria-labelledby="banner-tab">
            <h5>Current Banner</h5>

            <!-- Show the Current Banner Image -->
            @if($currentBannerImage)
            <div class="jumbotron paral paralsec d-flex align-items-center mt-3"
                style="background-image: url('{{ asset('sales_manager/banner/' . $currentBannerImage) }}'); background-size: cover; background-position: center;"></div>
            @else
            <p>No banner image uploaded.</p>
            @endif

            <!-- Form to Upload New Banner Image -->
            <form action="{{ route('admin.updateBannerImageForVT') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Banner Image Upload -->
                <div class="mb-3 mt-3">
                    <label for="banner_image" class="form-label">Upload New Banner Image</label>
                    <input type="file" name="banner_image" id="banner_image" class="form-control" accept="image/*">
                </div>

                <!-- Banner Label -->
                <div class="mb-3">
                    <label for="banner_label" class="form-label">Banner Label</label><span class="text-danger">*</span>
                    <input type="text" name="banner_label" id="banner_label" value="{{ $currentBannerLabel }}" class="form-control" required>
                </div>
                <button type="submit" class="save_btn">Save Changes</button>
            </form>
        </div>
    </div>
</section>


<script src="{{ asset('js/Admin/aboutdubaiproduction.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttonContainer = document.getElementById('button-fields-container');
        let fieldCount = buttonContainer.querySelectorAll('.input-field-group').length;

        // Function to add more input fields dynamically
        document.getElementById('add-more-btn').addEventListener('click', function() {
            fieldCount++;

            // Create a new div for the new fields
            let newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('mb-3', 'input-field-group', 'd-flex', 'gap-2', 'align-items-center', 'w-75');

            // Add new input fields for button text and link
            newFieldGroup.innerHTML = `
            <div class="d-flex gap-2">
                <input type="text" name="button_text[]" id="button_text_${fieldCount}" class="form-control" placeholder="Enter button text" required>
            </div>
            <div class="d-flex gap-2">
                <input type="url" name="button_link[]" id="button_link_${fieldCount}" class="form-control" placeholder="Enter button link" required>
            </div>
            <button type="button" class="remove-btn btn btn-danger">&#10006;</button>
        `;

            // Append the new fields to the container
            buttonContainer.appendChild(newFieldGroup);

            // Add event listener to the new remove button
            addRemoveButtonListener(newFieldGroup.querySelector('.remove-btn'));
        });

        // Function to add event listener to remove buttons
        function addRemoveButtonListener(button) {
            button.addEventListener('click', function() {
                this.closest('.input-field-group').remove();
            });
        }

        // Add event listeners to existing remove buttons
        buttonContainer.querySelectorAll('.remove-btn').forEach(addRemoveButtonListener);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
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
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                var order = $(this).sortable('toArray', {
                    attribute: 'data-id'
                });
                saveOrder(order);
            }
        });
        $("#sortable").disableSelection();
    });

    function saveOrder(order) {
        $.ajax({
            url: 'setDubaiTeamOrder', // Your route to handle the order saving
            method: 'POST',
            data: {
                order: order,
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function(response) {
                alert('Order saved successfully!');
            },
            error: function(xhr) {
                alert('Error saving order: ' + xhr.responseText);
            }
        });
    }
</script>
<script>
    const projectPicInput = document.getElementById('profilePicInput');
    const errorMessage = document.getElementById('errorMessage');
    const allowedFileTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

    projectPicInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (allowedFileTypes.includes(file.type)) {
                errorMessage.style.display = 'none';
                // Here you can handle the valid file, e.g., prepare it for upload
                console.log('Valid file selected:', file.name);
            } else {
                errorMessage.style.display = 'block';
                event.target.value = ''; // Reset the input
            }
        }
    });
</script>
<script>
    const projectPicInput1 = document.getElementById('editProfilePicInput'); // Corrected to match the HTML id
    const editerrorMessage = document.getElementById('editerrorMessage');
    const allowedFileTypes1 = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

    projectPicInput1.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (allowedFileTypes1.includes(file.type)) {
                editerrorMessage.style.display = 'none';
                console.log('Valid file selected:', file.name);
            } else {
                editerrorMessage.style.display = 'block';
                event.target.value = ''; // Reset the input
            }
        }
    });
</script>
<!-- CSS for Circle Display -->
<style>
    /* Profile Pic Container with Square Crop and Round Display */
    .profile-pic-container {
        width: 50px;
        /* Width and height set to make it a square */
        height: 50px;
        overflow: hidden;
        border-radius: 50%;
        /* Make the container circular */
        margin: 0 auto;
        position: relative;
    }

    /* Image styled to automatically crop and become round */
    .profile-pic {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures the image is cropped to fit the square */
    }

    /* Round the profile picture preview */
    .profile-pic-container img {
        border-radius: 50%;
    }

    .table-responsive {
        margin: 20px 0;
    }

    .table-bordered {
        border: 1px solid #ddd;
        background-color: #f9f9f9;
    }

    .table th,
    .table td {
        vertical-align: middle;
        padding: 15px;
    }

    .table thead {
        background-color: #f1f1f1;
    }

    .table .profile-pic-container {
        width: 50px;
        height: 50px;
        margin: auto;
        border-radius: 50%;
        overflow: hidden;
    }

    .table .profile-pic {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 14px;
    }

    .action {
        align-items: center;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
</style>
@endsection