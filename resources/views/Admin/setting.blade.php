@extends('layouts.main')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Admin/setting.css') }}" rel="stylesheet" />
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Flash Message Section -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-2 mx-4 noti_alert" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible mt-2 mx-4 noti_alert" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
    @endif
    <section class="p-4">
    <div class="heading">Settings</div>
    </section>
    <!-- ============ CALENDAR SECTION ============ -->
{{-- <form id="date-selection-form" action="{{ route('AdminPrefferdDates') }}" method="POST">
    @csrf
    <section class="p-4">
        <div class="heading">Settings</div>

        <!-- Preferred Dates Section -->
<div class="date-selection-section mt-4">
    <h4>Select Preferred Dates For Witness Test</h4>
    
    <!-- Bootstrap Row for Side-by-Side Layout -->
    <div class="row">
        <!-- Details Column - Takes 50% width -->
        <div class="col-md-6">
            <!-- Selected Date Display -->
            <div id="selected-date-display" class="mt-3 p-2 bg-light rounded" style="display: none;">
                <h5>Selected Date: <span id="selected-date-text"></span></h5>
            </div>

            <!-- Product Type Selection -->
            <div class="product-type-section mt-4" style="display: none;">
                <h4>Select Product Type <span class="text-danger">*</span></h4>
                <select name="product_type" id="product-type" class="form-select" required>
                    <option value="">Select Product Type</option>
                    @foreach($productTypes as $product)
                        <option value="{{ $product['id'] }}">
                            {{ $product['product_type_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Meeting Link Input -->
            <div class="meeting-link-section mt-4" style="display: none;">
                <h4>Paste Meeting Link <span class="text-danger">*</span></h4>
                <input type="text" name="meeting_link" id="meeting-link" class="form-control" 
                       placeholder="Paste meeting link here">
            </div>
        </div>
        <!-- Calendar Column - Takes 50% width -->
        <div class="col-md-6">
            <div class="calendar-header">
                <span id="prev-year" class="nav-button"><<</span>
                <span id="prev-month" class="nav-button"><</span>
                <span id="current-month-year" class="month-year-display"></span>
                <span id="next-month" class="nav-button">></span>
                <span id="next-year" class="nav-button">>></span>
            </div>
            <div class="calendar-days">
                <div class="calendar-day-name">Sun</div>
                <div class="calendar-day-name">Mon</div>
                <div class="calendar-day-name">Tue</div>
                <div class="calendar-day-name">Wed</div>
                <div class="calendar-day-name">Thu</div>
                <div class="calendar-day-name">Fri</div>
                <div class="calendar-day-name">Sat</div>
            </div>
            <div id="calendar-grid" class="calendar-grid"></div>
            <!-- Hidden field for selected date -->
            <input type="hidden" name="dates" id="selected-dates-hidden">
        </div>

        
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons mt-4" style="display: none;">
        <input type="hidden" name="action" id="form-action" value="save">
        <button type="button" id="save-date-btn" class="btn btn-success me-2">Save Date</button>
        <button type="button" id="delete-date-btn" class="btn btn-danger me-2">Delete Date</button>
        <button type="button" id="clear-selection-btn" class="btn btn-secondary">Clear Selection</button>
    </div>
</div>
    </section>
</form> --}}
<!-- ============ END CALENDAR SECTION ============ -->

    <!-- Email Update Section -->
    <section class="m-4 border border-info">
        <div class="email-update-section mt-4 px-4 pt-2 pb-4">
            <h4 class="mb-3">Update Emails</h4>
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div id="toast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <!-- <script>
                @if(session('success'))
                const toast = new bootstrap.Toast(document.getElementById('toast'));
                toast.show();
                @endif
            </script> -->

            <form id="email-update-form" action="{{ route('saveEmails1') }}" method="POST">
                @csrf

                <!-- Witness Test Emails -->
                <!-- <div class="d-flex w-100 email mb-3">
                    <div class="form-group w-25 me-3">
                        <label for="witness_test_mail">Change Witness Test Mail</label><span class="text-danger">*</span>
                        <input type="email" name="witness_test_mail" id="witness_test_mail" class="form-control"
                            placeholder="Enter witness test mail"
                            value="{{ old('witness_test_mail', $emails['witness_test']['primary']) }}" required>
                    </div>
                    <div class="form-group w-25">
                        <label for="witness_test_mail_secondary">Change Witness Test Secondary Mail</label>
                        <input type="email" name="witness_test_mail_secondary" id="witness_test_mail_secondary"
                            class="form-control" placeholder="Enter secondary witness test mail"
                            value="{{ old('witness_test_mail_secondary', $emails['witness_test']['secondary']) }}">
                    </div>
                </div> -->

                <!-- Requesting Emails -->
                <div class="d-flex w-100 email mb-3">
                    <div class="form-group w-25 me-3">
                        <label for="requesting_mail">Change Requesting Mail</label><span class="text-danger">*</span>
                        <input type="email" name="requesting_mail" id="requesting_mail" class="form-control"
                            placeholder="Enter requesting mail"
                            value="{{ old('requesting_mail', $emails['requesting_mail']['primary']) }}" required>
                    </div>
                    <div class="form-group w-25">
                        <label for="requesting_mail_secondary">Change Requesting Secondary Mail</label>
                        <input type="email" name="requesting_mail_secondary" id="requesting_mail_secondary"
                            class="form-control" placeholder="Enter secondary requesting mail"
                            value="{{ old('requesting_mail_secondary', $emails['requesting_mail']['secondary']) }}">
                    </div>
                </div>

                <!-- Feedback Form Emails -->
                <div class="d-flex w-100 email mb-3">
                    <div class="form-group w-25 me-3">
                        <label for="feedback_form_mail">Change Feedback Form Mail</label><span class="text-danger">*</span>
                        <input type="email" name="feedback_form_mail" id="feedback_form_mail" class="form-control"
                            placeholder="Enter feedback form mail"
                            value="{{ old('feedback_form_mail', $emails['feedback_form']['primary']) }}" required>
                    </div>
                    <div class="form-group w-25">
                        <label for="feedback_form_mail_secondary">Change Feedback Form Secondary Mail</label>
                        <input type="email" name="feedback_form_mail_secondary" id="feedback_form_mail_secondary"
                            class="form-control" placeholder="Enter secondary feedback form mail"
                            value="{{ old('feedback_form_mail_secondary', $emails['feedback_form']['secondary']) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Emails</button>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        const adminPreferredDatesUrl = "{{ route('AdminPrefferdDates') }}";
        const getPreferredDateDetailsUrl = "{{ route('getPreferredDateDetails') }}";
    </script>
    <script>
        const savedDates = @json($savedDates);
    </script>
    <script src="{{ asset('js/Admin/setting.js') }}"></script>
@endsection