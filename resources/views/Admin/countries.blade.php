@extends('layouts.main')
@section('content')

<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/countries.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<section class="p-4">
    <div class="row">
        <div class="col-xl-6">
            <div class="heading">
                Manage Countries
            </div>
        </div>
        <div class="col-xl-6">
            <button class="btn btn-primary mb-3 float-right" data-bs-toggle="modal" data-bs-target="#addCountryModal">+ Add Country</button>
        </div>
    </div>
    <!-- Flash Message Section -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mt-2 noti_alert" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible mt-2 noti_alert" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="countries_table">
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Country Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->country_code }}</td>
                    <td class="action">
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-url="{{ route('admin.countries.destroy', $country->id) }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Country Modal -->
    <div class="modal" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryModalLabel">Add Country</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Error message container -->
                    <div id="countryErrorMessage" class="alert alert-danger mb-3 d-none" role="alert">
                        Please select a country before saving.
                        <button type="button" class="btn-close float-right" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <form id="addCountryForm" action="{{ route('admin.countries.store') }}" method="POST">
                        @csrf
                        <!-- Country Selector Field -->
                        <div class="form-group">
                            <div class="d-flex align-items-center">
                                <label for="countrySelector" class="form-label mb-0">Select Country</label><span class="text-danger">*</span>
                                <!-- Country selection input (hidden number input) -->
                                <input type="tel" id="phone" class="form-control" style="visibility: hidden; position: absolute;" required>
                            </div>

                            <!-- Display selected country name and code in a read-only input -->
                            <input type="text" id="displayCountry" class="form-control mt-3" placeholder="Select a country" readonly>

                            <!-- Hidden fields to store selected country name and code -->
                            <input type="hidden" name="country_name" id="country_name" required>
                            <input type="hidden" name="country_code" id="country_code" required>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-dark bg_dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="saveCountryBtn" class="btn btn-primary">Save Country</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Add Delete Confirmation Modal -->
    <div class="modal" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this country?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark bg_dark" data-bs-dismiss="modal">Cancel</button>
                    <!-- Delete form dynamically injected here -->
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js"></script>
<script src="{{ asset('js/Admin/countries.js') }}"></script>

@endsection