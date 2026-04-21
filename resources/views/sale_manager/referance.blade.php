@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />

<link href="{{ asset('css/Admin/reference.css') }}" rel="stylesheet" />
<!-- Bootstrap CSS (already included in most cases) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">

<style>
    #fullSizeImage {
        width: 500px;
        height: 300px;
        object-fit: contain;
        background-color: #f5f5f5;
        /* Optional: Adds a background to fill empty space */
    }

    th {
        background-color: #169d87 !important;
        color: white !important;
    }

    /* start - Close Button Styles - 08-01-2025 */
    .btn-close {
        background: none;
        border: none;
        width: 1rem;
        height: 1rem;
        position: relative;
        cursor: pointer;
    }

    .btn-close::before,
    .btn-close::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 1rem;
        height: 2px;
        background-color: white;
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .btn-close::after {
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .btn-close:focus {
        outline: none;
    }
    /* end - Close Button Styles - 08-01-2025 */
</style>

<section class="p-3 d-flex justify-content-between align-items-center">
    <div class="ml-2">
        <a href="{{ route('SaleManagerDashboard') }}" class="btn btn-primary custom-back c-back">
            <svg xmlns="http://www.w3.org/2000/svg" class="back-svg mr-0" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            Back
        </a>
    </div>
</section>

<section class="px-4">
    <h1>Reference Table </h1>
</section>

<!-- Table to display saved projects -->
<section class="px-4">
    <!-- Projects Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle text-center" id="ref_table">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Project Image</th>
                    <th scope="col">Country</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">About Project</th>
                    <th scope="col">Product Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        @if($project->project_pic)
                        <img src="{{ asset('sales_manager/reference_table/' . $project->project_pic) }}" alt="Project Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;" onclick="openImageModal(this.src)">
                        @else
                        <img src="{{ asset('sales_manager/reference_table/default_reference.png') }}" alt="Project Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;" onclick="openImageModal(this.src)">
                        @endif
                    </td>
                    <td>{{ $project->country }}</td>
                    <td>
                        <span class="text-center">{{ Str::limit($project->project_name, 35) }}</span>
                    </td>

                    <td>
                        <span class="text-center">
                            {{ Str::limit($project->discretion, 15) }}
                            @if(strlen($project->discretion) > 15)
                            <button
                                class="btn btn-link read-more"
                                data-bs-toggle="modal"
                                data-bs-target="#readMoreModal"
                                data-full-text="{{ $project->discretion }}">
                                Read More
                            </button>
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class=" text-center">{{ $project->product_type }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Read More Modal -->
<div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
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
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Project Image</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="fullSizeImage" src="" alt="Full Size Image" style="width: 500px; height: 300px; object-fit: contain;">
            </div>            
        </div>
    </div>
</div>


<!-- DataTables -->
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
    // Handle Read More modal
    var readMoreModal = document.getElementById('readMoreModal');
    readMoreModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget; // Button that triggered the modal
        var fullText = button.getAttribute('data-full-text');
        var modalBody = readMoreModal.querySelector('.modal-body p');
        modalBody.textContent = fullText;
    });
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
                    targets: [0, 1, 2, 3, 4]
                },
                {
                    orderable: false,
                    targets: []
                } // Adjust if needed
            ]
        });
    });

    function openImageModal(imageSrc) {
        document.getElementById('fullSizeImage').src = imageSrc;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>

<!-- Add More Parallax Sections Here -->
@endsection