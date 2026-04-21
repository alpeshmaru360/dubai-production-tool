{{-- <!-- @extends('layouts.main')
@section('content') -->
<!-- <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/reference.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->


<!-- <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/reference.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<section class="p-3 d-flex justify-content-between align-items-center">
    <div class="ml-2">
        <a href="{{ route('AdminDashboard') }}" class="btn btn-primary custom-back c-back">
            <svg xmlns="http://www.w3.org/2000/svg" class="back-svg mr-0" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            Back
        </a>
    </div>
</section>

<section class="px-4 py-2">
    <div class="row">
        <div class="col-xl-6">
            <div class="heading">
                Reference table
            </div>
        </div>
        <div class="col-xl-6">
            <button type="button" class="btn btn-primary custom-add float-right" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
                + Add
            </button>
        </div>
    </div>
</section>

@if(session('success'))
<div class="alert alert-success alert-dismissible mt-2" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('success') }}
</div>
@endif

<section class="p-4 pt-0">
    <div class="table-responsive">
        <table class="table table-hover table-custom" id="ref_table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" style="width: 15%;">Project Image</th>
                    <th scope="col">Country</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">About Project</th>
                    <th scope="col">Product Type</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        @if($project->project_pic)
                        <img src="{{ asset('sales_manager/reference_table/' . $project->project_pic) }}" alt="Project Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;" onclick="openImageModal(this.src)">
                        @else
                        <img src="{{ asset('sales_manager/reference_table/default_reference.png') }}" alt="Project Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;" onclick="openImageModal(this.src)">
                        @endif
                    </td>
                    <td>{{ Str::limit($project->country, 25) }}</td>
                    <td>
                        <span class="text-center">{{ Str::limit($project->project_name, 25) }}</span>
                    </td>

                    <td>
                        <span class="text-center">
                            {{ Str::limit($project->discretion, 25) }}
                            @if(strlen($project->discretion) > 25)
                            <button class="btn btn-link read-more" data-bs-toggle="modal" data-bs-target="#readMoreModal" data-full-text="{{ $project->discretion }}">Read More</button>
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="text-center">{{ $project->product_type }}</span>
                    </td>

                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="{{ $project->id }}"
                                data-country="{{ $project->country }}"
                                data-project-name="{{ $project->project_name }}"
                                data-about-project="{{ $project->discretion }}"
                                data-product-type="{{ $project->product_type }}"
                                aria-label="Edit project">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#169e88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmModal"
                                data-project-id="{{ $project->id }}"
                                aria-label="Delete project">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#169e88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section> -->

<!-- Add Modal
<div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered edit_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabel">Add New Project</h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            <!-- </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('RefTable.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex w-100 gap-2">
                        <div class="mb-3 w-50">
                            <label for="country" class="form-label">Country</label><span class="text-danger">*</span>
                            <select class="form-select" id="country" name="country" required>
                                <option selected disabled>Choose a country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 w-50">
                            <label for="projectName" class="form-label">Project Name</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" id="projectName" name="project_name" placeholder="Enter project name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="aboutProject" class="form-label">About the Project</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="aboutProject" name="about_project" rows="4" placeholder="Describe the project" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_type" class="form-label">Product</label><span class="text-danger">*</span>
                        <select class="form-select" id="product_type" name="product_type" required>
                            <option selected disabled>Choose a Product Type</option>
                            @foreach ($Products as $Product)
                            <option value="{{ $Product->product_type_name }}">{{ $Product->product_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="projectPic" class="form-label">Project Image<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="projectPic" name="project_pic" accept="image/jpeg,image/png,image/webp,image/jpg" required>
                        <div id="errorMessage" class="error-message">Please upload only jpg, png, webp, or jpeg files.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- Edit Modal -->
<!-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered edit_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Project</h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            <!-- </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('RefTable.update', ':id') }}" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex w-100 gap-2">
                        <div class="mb-3 w-50">
                            <label for="editCountry" class="form-label">Country</label><span class="text-danger">*</span>
                            <select class="form-select" id="editCountry" name="country" required>
                                <option selected disabled>Choose a country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 w-50">
                            <label for="editProjectName" class="form-label">Project Name</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" id="editProjectName" name="project_name" placeholder="Enter project name" required>

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editAboutProject" class="form-label">About the Project</label><span class="text-danger">*</span>
                        <textarea class="form-control" id="editAboutProject" name="about_project" rows="4" placeholder="Describe the project" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductType" class="form-label">Product</label><span class="text-danger">*</span>
                        <select class="form-select" id="editProductType" name="product_type" required>
                            <option selected disabled>Choose a Product Type</option>
                            @foreach ($Products as $Product)
                            <option value="{{ $Product->product_type_name }}">{{ $Product->product_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editProjectPic" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="editProjectPic" name="project_pic" accept="image/jpeg,image/jpg,image/png,image/webp">
                        <div id="editerrorMessage" class="error-message">Please upload only jpg, png, webp, or jpeg files.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- Delete Confirmation Modal -->
<!-- <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            <!-- </div>
            <div class="modal-body">
                Are you sure you want to delete this project?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="{{ route('RefTable.destroy', ':id') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- Read More Modal -->
<!-- <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readMoreModalLabel">About Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="fullProjectDescription"></p>
            </div>
        </div>
    </div>
</div> -->

<!-- Image Modal -->
<!-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Project Image</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body text-center">
                <img id="fullSizeImage" src="" alt="Full Size Image" style="width: 500px; height: 300px; object-fit: contain;">
            </div>
        </div>
    </div>
</div> -->


<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- DataTables -->
<!-- <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> -->

<!-- <script src="{{ asset('js/Admin/reference.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#ref_table').DataTable({
            paging: true,
            pageLength: 10,
            lengthMenu: [2, 5, 10, 25, 50, 100],
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    orderable: true,
                    targets: [0, 1, 2, 4, 5]
                },
                {
                    orderable: false,
                    targets: [5, 6, 3]
                }
            ]
        });
    });

    function openImageModal(imageSrc) {
        document.getElementById('fullSizeImage').src = imageSrc;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>
<script>
    const projectPicInput = document.getElementById('projectPic');
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
    const projectPicInput1 = document.getElementById('editProjectPic'); // Corrected to match the HTML id
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

@endsection -->  --}}


@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('css/Admin/pricing_tool.css') }}" rel="stylesheet" />
<section class="p-4">
    <div class="heading">Manage Referance Table</div>
    <!-- Flash Message Section -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mt-2 noti_alert" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('UpdateReferenceTable') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <div class="form-group">
                <label for="reference_table_link">Update Reference Table Link:</label><span class="text-danger">*</span>
                <input type="url" id="reference_table_link" name="reference_table_link" class="form-control"
                    value="{{ $referenceTableLink ?? '' }}" placeholder="Enter new link for Reference Table" required>
            </div>
            <div class="form-group">
                <button type="submit" class="save_btn">Save</button>
            </div>
        </div>
    </form>
</section>

@endsection