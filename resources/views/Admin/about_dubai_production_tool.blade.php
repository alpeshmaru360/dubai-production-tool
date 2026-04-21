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

    <div class="heading">About Dubai Production Tool</div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mt-4" id="productionToolTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="banner-tab" data-bs-toggle="tab" data-bs-target="#banner" type="button" role="tab" aria-controls="banner" aria-selected="true">Banner</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button" role="tab" aria-controls="location" aria-selected="false">Location</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pumpTesting-tab" data-bs-toggle="tab" data-bs-target="#pumpTesting" type="button" role="tab" aria-controls="pumpTesting" aria-selected="false">Pump Testing Facility</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ProductRange-tab" data-bs-toggle="tab" data-bs-target="#ProductRange" type="button" role="tab" aria-controls="ProductRange" aria-selected="false">Product Range</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="quality-tab" data-bs-toggle="tab" data-bs-target="#quality" type="button" role="tab" aria-controls="quality" aria-selected="false">Quality</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sustainability-tab" data-bs-toggle="tab" data-bs-target="#sustainability" type="button" role="tab" aria-controls="sustainability" aria-selected="false">Sustainability</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" type="button" role="tab" aria-controls="team" aria-selected="false">Team</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="innovation-tab" data-bs-toggle="tab" data-bs-target="#innovation" type="button" role="tab" aria-controls="innovation" aria-selected="false">Innovation</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="productionToolTabsContent">
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
            <form action="{{ route('admin.updateBannerImage') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Initial Paragraph Section -->
                <div class="mb-3">
                    <label for="initial_paragraph" class="form-label">Under Banner Paragraph</label><span class="text-danger">*</span>
                    <textarea name="initial_paragraph" id="initial_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('initial_paragraph', $currentInitialParagraph) }}</textarea>
                </div>

                <button type="submit" class="save_btn">Save Changes</button>
            </form>
        </div>

        <!-- Location Tab -->
        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
            <!-- Form to Update Location Section -->
            <form action="{{ route('admin.updateLocation') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Location Section Heading -->
                <div class="mb-3">
                    <label for="location_heading" class="form-label">Location Section Heading</label><span class="text-danger">*</span>
                    <input type="text" name="location_heading" id="location_heading" value="{{ $currentLocationHeading }}" class="form-control" required>
                </div>

                <!-- Location Paragraph -->
                <div class="mb-3">
                    <label for="location_paragraph" class="form-label">Location Paragraph</label><span class="text-danger">*</span>
                    <textarea name="location_paragraph" id="location_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('location_paragraph', $currentLocationParagraph) }}</textarea>
                </div>

                <!-- Location Paragraph -->
                <div class="mb-3">
                    <label for="location_link" class="form-label">Location Link</label><span class="text-danger">*</span>
                    <input type="url" name="location_link" id="location_link" class="form-control" value="{{ old('location_link', $currentLocationLink) }}" required>
                </div>

                <!-- Show the Current Location Image -->
                <label for="location_heading" class="form-label d-block">Current Location Image</label>
                @if($currentLocationImage)
                <img src="{{ asset('sales_manager/images/' . $currentLocationImage) }}" alt="">
                @else
                <p>No location image uploaded.</p>
                @endif
                <!-- Location Image Upload -->
                <div class="mb-3 mt-3">
                    <label for="location_image" class="form-label">Upload New Location Image</label>
                    <input type="file" name="location_image" id="location_image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="save_btn">Save Changes</button>
            </form>
        </div>

        <!-- Pump Testing Facility Tab -->
        <div class="tab-pane fade" id="pumpTesting" role="tabpanel" aria-labelledby="pumpTesting-tab">
            <form action="{{ route('admin.updatePumpTestingFacility') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Pump Testing Facility Heading -->
                <div class="mb-3">
                    <label for="pump_facility_heading" class="form-label">Accredited Pump Testing Facility Heading</label><span class="text-danger">*</span>
                    <input type="text" name="pump_facility_heading" id="pump_facility_heading" value="{{ $currentPumpFacilityHeading }}" class="form-control" required>
                </div>

                <!-- Pump Testing Facility Paragraph -->
                <div class="mb-3">
                    <label for="pump_facility_paragraph" class="form-label">Accredited Pump Testing Facility Paragraph</label><span class="text-danger">*</span>
                    <textarea name="pump_facility_paragraph" id="pump_facility_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('pump_facility_paragraph', $currentPumpFacilityParagraph) }}</textarea>
                </div>

                <!-- Display Current Testing Facility Images -->
                <label for="location_heading" class="form-label d-block">Crurrent Testing Facility Image</label>
                <div class="image-container d-flex gap-3 mb-3">
                    @if($currentTestingFacilityImage1)
                    <div class="image-box">
                        <img src="{{ asset('sales_manager/images/' . $currentTestingFacilityImage1) }}" alt="Testing Facility Image 1" class="img-fluid">
                    </div>
                    @endif
                    @if($currentTestingFacilityImage2)
                    <div class="image-box">
                        <img src="{{ asset('sales_manager/images/' . $currentTestingFacilityImage2) }}" alt="Testing Facility Image 2" class="img-fluid">
                    </div>
                    @endif
                </div>

                <!-- Testing Facility Image 1 Upload -->
                <div class="mb-3 mt-3">
                    <label for="testing_facility_image_1" class="form-label">Upload New Testing Facility First Image</label>
                    <input type="file" name="testing_facility_image_1" id="testing_facility_image_1" class="form-control" accept="image/*">
                </div>

                <!-- Testing Facility Image 2 Upload -->
                <div class="mb-3 mt-3">
                    <label for="testing_facility_image_2" class="form-label">Upload New Testing Facility Second Image</label>
                    <input type="file" name="testing_facility_image_2" id="testing_facility_image_2" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="save_btn">Save Changes</button>
            </form>
        </div>


        <!-- Product Range Tab -->
        <div class="tab-pane fade" id="ProductRange" role="tabpanel" aria-labelledby="ProductRange-tab">
            <form action="{{ route('admin.updateProductRange') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Range Heading -->
                <div class="mb-3">
                    <label for="Product_range_heading" class="form-label">Product Range Heading</label><span class="text-danger">*</span>
                    <input type="text" name="Product_range_heading" id="Product_range_heading" class="form-control" value="{{ old('Product_range_heading', $currentProductRangeHeading) }}" required>
                </div>

                <!-- Product Range Description -->
                <div class="mb-3">
                    <label for="Product_range_paragraph" class="form-label">Product Range Description</label><span class="text-danger">*</span>
                    <textarea name="Product_range_paragraph" id="Product_range_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('Product_range_paragraph', $currentProductRangeParagraph) }}</textarea>
                </div>

                <label for="Product_range_button" class="form-label d-block">Product Range Button Label and Links<span class="text-danger">*</span></label>
                <!-- Dynamic Input Fields for Button Text and Links -->
                <div id="button-fields-container" class="gap-3">
                    @foreach($productButtons as $index => $button)
                    <div class="mb-3 input-field-group d-flex gap-2 align-items-center w-75">
                        <div class="d-flex gap-2">
                            <input type="text" name="button_text[]" value="{{ $button->button_text }}" id="button_text_{{ $index + 1 }}" class="form-control" placeholder="Enter button text" required>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="url" name="button_link[]" value="{{ $button->button_link }}" id="button_link_{{ $index + 1 }}" class="form-control" placeholder="Enter button link" required>
                        </div>
                        <button type="button" class="remove-btn btn btn-danger hidden">&#10006;</button>
                    </div>
                    @endforeach
                </div>

                <!-- Add More Button -->
                <!-- <button type="button" class="btn btn-success d-block" id="add-more-btn">&#43 Add</button> -->

                <button type="submit" class="save_btn mt-5">Save Changes</button>
            </form>
        </div>

        <!-- Quality Tab -->
        <div class="tab-pane fade" id="quality" role="tabpanel" aria-labelledby="Quality-tab">
            <form action="{{ route('admin.updateQuality') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Quality Heading -->
                <div class="mb-3">
                    <label for="quality_heading" class="form-label">Quality Heading</label><span class="text-danger">*</span>
                    <input type="text" name="quality_heading" id="quality_heading" class="form-control" value="{{ old('quality_heading', $currentQualityHeading) }}" required>
                </div>

                <!-- Quality Description -->
                <div class="mb-3">
                    <label for="quality_paragraph" class="form-label">Quality Description</label><span class="text-danger">*</span>
                    <textarea name="quality_paragraph" id="quality_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('quality_paragraph', $currentQualityParagraph) }}</textarea>
                </div>

                <div class="mt-5 w-100 d-flex gap-4 justify-content-between">
                    <!-- Display Current Quality Image -->
                    <div class="card w-75 m-auto shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase document_title text-bold mb-3 w-100">Currnet Quality Image</h5>
                            @if($currentQualityImage)
                            <div class="mb-4">
                                <img src="{{ asset('sales_manager/images/' . $currentQualityImage) }}" alt="Quality Image" class="img-fluid">
                            </div>
                            @else
                            <p class="text-muted">No quality image uploaded yet.</p>
                            @endif
                            <label for="quality_image" class="form-label mt-3">Upload New Quality Image</label>
                            <input type="file" name="quality_image" id="quality_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>


                <div class="mt-5 w-100 d-flex gap-4 justify-content-between">
                    <!-- Display Current ISO 9001 Document -->
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase document_title text-bold mb-3 w-100">ISO 9001 Document</h5>
                            @if($currentISO9001Document)
                            <a href="{{ asset('sales_manager/documents/' . $currentISO9001Document) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentISO9001Document}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="ISO_9001_document" class="form-label mt-3">Upload new</label>
                            <input type="file" name="ISO_9001_document" id="ISO_9001_document" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>

                    <!-- Display Current ISO 45001 Document -->
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase mb-3 text-bold w-100">ISO 45001 Document</h5>
                            @if($currentISO45001Document)
                            <a href="{{ asset('sales_manager/documents/' . $currentISO45001Document) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentISO45001Document}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="ISO_45001_document" class="form-label mt-3">Upload new</label>
                            <input type="file" name="ISO_45001_document" id="ISO_45001_document" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-5">
                    <button type="submit" class="save_btn">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Sustainability Tab -->
        <div class="tab-pane fade" id="sustainability" role="tabpanel" aria-labelledby="sustainability-tab">
            <form action="{{ route('admin.updateSustainability') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Sustainability Heading -->
                <div class="mb-3">
                    <label for="sustainability_heading" class="form-label">Sustainability Heading</label><span class="text-danger">*</span>
                    <input type="text" name="sustainability_heading" id="sustainability_heading" class="form-control" value="{{ old('sustainability_heading', $currentSustainabilityHeading) }}" required>
                </div>

                <!-- Sustainability Description -->
                <div class="mb-3">
                    <label for="sustainability_paragraph" class="form-label">Sustainability Description</label><span class="text-danger">*</span>
                    <textarea name="sustainability_paragraph" id="sustainability_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('sustainability_paragraph', $currentSustainabilityParagraph) }}</textarea>
                </div>


                <!-- Display and Edit Sustainability Document -->
                <div class="mt-5 w-100 d-flex gap-4 justify-content-between">
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_1_lable" id="sustainability_button_1_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_1_lable', $currentsustainability_button_1) }}" required>
                            @if($currentsustainability_document_1)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_1) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_1}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_1" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_1" id="sustainability_document_1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_2_lable" id="sustainability_button_2_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_2_lable', $currentsustainability_button_2) }}" required>
                            @if($currentsustainability_document_2)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_2) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_2}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_2" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_2" id="sustainability_document_2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_3_lable" id="sustainability_button_3_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_3_lable', $currentsustainability_button_3) }}" required>
                            @if($currentsustainability_document_3)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_3) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_3}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_3" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_3" id="sustainability_document_3" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                </div>

                <div class="mt-5 w-100 d-flex gap-4 justify-content-between">
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_4_lable" id="sustainability_button_4_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_4_lable', $currentsustainability_button_4) }}" required>
                            @if($currentsustainability_document_4)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_4) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_4}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_4" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_4" id="sustainability_document_4" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_5_lable" id="sustainability_button_5_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_5_lable', $currentsustainability_button_5) }}" required>
                            @if($currentsustainability_document_5)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_5) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_5}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_5" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_5" id="sustainability_document_5" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                    <div class="card w-50 shadow-sm p-4 border rounded-lg">
                        <div class="card-body text-center">
                            <input type="text" name="sustainability_button_6_lable" id="sustainability_button_6_lable" class="form-control mb-2 text-center text-bold" value="{{ old('sustainability_button_6_lable', $currentsustainability_button_6) }}" required>
                            @if($currentsustainability_document_6)
                            <a href="{{ asset('sales_manager/documents/' . $currentsustainability_document_6) }}" target="_blank" class="btn btn-outline-primary w-100">
                                <i class="fas fa-file-alt me-2"></i> {{$currentsustainability_document_6}}
                            </a>
                            @else
                            <p class="text-muted">No document uploaded yet.</p>
                            @endif
                            <label for="sustainability_document_6" class="form-label mt-3">Upload new</label>
                            <input type="file" name="sustainability_document_6" id="sustainability_document_6" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt" value="">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-5">
                    <button type="submit" class="save_btn">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Team tab -->
        <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
            <form action="{{ route('admin.updateTeam') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Team Heading -->
                <div class="mb-3">
                    <label for="team_heading" class="form-label">Team Heading</label><span class="text-danger">*</span>
                    <input type="text" name="team_heading" id="team_heading" class="form-control" value="{{ old('team_heading', $currentTeamHeading) }}" required>
                </div>

                <!-- Team Description -->
                <div class="mb-3">
                    <label for="team_paragraph" class="form-label">Team Description</label><span class="text-danger">*</span>
                    <textarea name="team_paragraph" id="team_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('team_paragraph', $currentTeamParagraph) }}</textarea>
                </div>

                <!-- Save Button -->
                <div class="mt-5">
                    <button type="submit" class="save_btn">Save Changes</button>
                </div>
            </form>
            <section class="p-2">
                <!-- Add Member Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success custom_bg_color" data-bs-toggle="modal" data-bs-target="#addMemberModal">+ Add Member</button>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="team_table">
                        <thead class="table-light">
                            <tr>
                                <th>Profile Picture</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($members as $member)
                            <tr data-id="{{ $member->id }}">
                                <td>
                                    <div class="profile-pic-container">
                                        @if(file_exists(public_path('sales_manager/team_about_dubai/' . $member->profile_pic)) && !empty($member->profile_pic))
                                        <img src="{{ asset('sales_manager/team_about_dubai/' . $member->profile_pic) }}" alt="Profile Pic" class="profile-pic">
                                        @else
                                        <img id="profilePicPreview" src="{{ asset('sales_manager/team_about_dubai/default_user.jpg') }}" alt="Profile Picture" class="profile-pic mb-2" height="100" width="100">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->designation }}</td>
                                <td>{{ $member->email }}</td>
                                <td class="action">
                                    <button class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editMemberModal"
                                        onclick="fetchMember({{ $member->id }})">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $member->id }})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!--Add Modal -->
                <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMemberModalLabel">Add New Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('about-dubai.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <!-- Profile Picture -->
                                        <div class="col-12 mb-3 text-center">
                                            <label for="profilePic" class="form-label">Profile Picture</label>
                                            <div class="profile-pic-container">
                                                <img id="profilePicPreview_add"
                                                    src="{{ asset('sales_manager/team_about_dubai/default_user.jpg') }}"
                                                    alt="Profile Picture"
                                                    class="profile-pic mb-2"
                                                    height="100"
                                                    width="100"
                                                    onclick="document.getElementById('profilePicInput').click();">

                                            </div>
                                            <!-- Hidden File Input -->
                                            <input type="file"
                                                class="form-control mt-2"
                                                id="profilePicInput"
                                                name="profile_pic"
                                                style="display: none;"
                                                accept="image/jpeg, image/png, image/webp, image/jpg"
                                                onchange="previewImage_add(event)">
                                            <div id="errorMessage" class="error-message">Please upload only JPG, PNG, WEBP, or JPEG files. Your current profile picture will not be lost upon saving.</div>

                                        </div>

                                        <!-- Name -->
                                        <div class="col-12 mb-3">
                                            <label for="name" class="form-label">Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                                        </div>

                                        <!-- Designation -->
                                        <div class="col-12 mb-3">
                                            <label for="designation" class="form-label">Designation</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" required>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label">Email</label><span class="text-danger">*</span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>


                                    <!-- Submit Button -->
                                    <button type="submit" class="btn w-100" style="background-color: #059b80; color: white;">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Edit Modal -->
                <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editMemberForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <div class="row">

                                        <div class="col-12 mb-3 text-center">
                                            <label for="editProfilePic" class="form-label">Profile Picture</label>
                                            <div class="profile-pic-container">
                                                <img id="editProfilePicPreview"
                                                    src="{{ asset('sales_manager/team_about_dubai/default_user.jpg') }}"
                                                    alt="Profile Picture"
                                                    class="profile-pic mb-2"
                                                    height="100"
                                                    width="100"
                                                    onclick="document.getElementById('editProfilePicInput').click();">
                                            </div>
                                            <input type="file" class="form-control mt-2" id="editProfilePicInput" name="profile_pic" style="display: none;" accept="image/jpeg, image/png,image/jpg, image/webp" onchange="previewImage(event, 'editProfilePicPreview')">
                                            <div id="editerrorMessage" class="error-message text-center">Please upload only JPG, PNG, WEBP, or JPEG files. Your current profile picture will not be lost upon saving.</div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="editName" class="form-label">Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="editName" name="name" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="editDesignation" class="form-label">Designation</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="editDesignation" name="designation" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="editEmail" class="form-label">Email</label><span class="text-danger">*</span>
                                            <input type="email" class="form-control" id="editEmail" name="email" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn w-100" style="background-color: #059b80; color: white;">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteMemberModalLabel">Confirm Deletion</h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this member?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary cancel_button" data-dismiss="modal">Cancel</button>
                                <form id="deleteMemberForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Innovation Tab -->
        <div class="tab-pane fade" id="innovation" role="tabpanel" aria-labelledby="innovation-tab">
            <form action="{{ route('admin.updateInnovation') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Innovation Heading -->
                <div class="mb-3">
                    <label for="innovation_heading" class="form-label">Innovation Heading</label><span class="text-danger">*</span>
                    <input type="text" name="innovation_heading" id="innovation_heading" class="form-control" value="{{ old('innovation_heading', $currentInnovaionHeading) }}" required>
                </div>

                <!-- Innovation Paragraph -->
                <div class="mb-3">
                    <label for="innovation_paragraph" class="form-label">Innovation Paragraph</label><span class="text-danger">*</span>
                    <textarea name="innovation_paragraph" id="innovation_paragraph" class="form-control" style="width: 100%; height: 100px;" required>{{ old('innovation_paragraph', $currentInnovaionParagraph) }}</textarea>
                </div>

                <!-- Display Current Innovation Images -->
                <div class="row w-100 mt-4">
                    <div class="w-100 mx-auto text-center d-flex justify-content-between">
                        <div class="success_box">
                            <img src="{{ asset('sales_manager/images/' . $currentSuccessStory_image_1) }}" class="mt-2 success-image" alt="Image 1">
                        </div>
                        <div class="success_box">
                            <img src="{{ asset('sales_manager/images/' . $currentSuccessStory_image_2) }}" class="mt-2 success-image" alt="Image 2">
                        </div>
                        <div class="success_box">
                            <img src="{{ asset('sales_manager/images/' . $currentSuccessStory_image_3) }}" class="mt-2 success-image" alt="Image 3">
                        </div>
                    </div>
                </div>

                <!-- Innovation Image 1 Upload -->
                <div class="mb-3 mt-3">
                    <label for="success_image_image_1" class="form-label">Upload New success-image 1</label>
                    <input type="file" name="success_image_image_1" id="success_image_image_1" class="form-control" accept="image/*">
                </div>

                <!-- Innovation Image 2 Upload -->
                <div class="mb-3 mt-3">
                    <label for="success_image_image_2" class="form-label">Upload New success-image 2</label>
                    <input type="file" name="success_image_image_2" id="success_image_image_2" class="form-control" accept="image/*">
                </div>

                <!-- Innovation Image 3 Upload -->
                <div class="mb-3 mt-3">
                    <label for="success_image_image_3" class="form-label">Upload New success-image 3</label>
                    <input type="file" name="success_image_image_3" id="success_image_image_3" class="form-control" accept="image/*">
                </div>

                <!-- Save Button -->
                <div class="">
                    <button type="submit" class="save_btn">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</section>


<script src="{{ asset('js/Admin/aboutdubaiproduction.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/Admin/aboutdubaiproduction2.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/Admin/aboutdubaiproduction3.js') }}"></script>
@endsection