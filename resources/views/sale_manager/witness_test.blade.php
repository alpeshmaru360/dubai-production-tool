@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/witness_test.css') }}" rel="stylesheet" />
<link href="{{ asset('css/role.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="dubai_production_section bg-white phone_responsive">
    <!-- First Parallax Section -->
    <a href="{{route('SaleManagerDashboard')}}" class="btn btn-primary custom-back c-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path
                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>Back
    </a>
    <div class="user_registration_section">
        <div class="container">
            <div class="body-content">
                <div class="formm p-4 rounded shadow-lg bg-white">
                    <h3 class="text-center mb-4">Witness Test Form</h3>

                    <form id="witnessForm" method="post">
                        @csrf

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <span class="text-danger mandatory"></span>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{Auth::user()->name}}" style="border-radius: 8px !important;">
                            <span class="text-danger" id="usernameError"></span>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <span class="text-danger mandatory"></span>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{Auth::user()->phone}}" style="border-radius: 8px !important;">
                            <span class="text-danger" id="phoneError"></span>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <span class="text-danger mandatory"></span>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{Auth::user()->email}}" style="border-radius: 8px !important;">
                            <span class="text-danger" id="emailError"></span>
                        </div>

                        <!-- Product Types -->
                        <div class="form-group">
                            <label for="product_type">Product Type</label>
                            <span class="text-danger mandatory"></span>
                            <select class="form-control" id="product_type" name="product_type">
                                <option value="">Select Product Type</option>
                                @foreach($productTypes as $productType)
                                <option value="{{ $productType->id }}">{{ $productType->product_type_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="productTypeError"></span>
                        </div>

                        <!-- Preferred Date -->
                        <div class="form-group">
                            <label for="preferred_date">Preferred Date</label>
                            <span class="text-danger mandatory"></span>
                            <input type="text" class="form-control" id="preferred_date" name="preferred_date" readonly
                                placeholder="Select product type first"
                                style="border-radius: 8px !important; background-color: #e9ecef;">
                            <input type="hidden" id="preferred_date_value" name="preferred_date_value">
                            <span class="text-danger" id="preferredDateError"></span>
                            <div class="date-message" id="dateMessage"></div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="form-group">
                            <label for="additional_notes">Additional Notes</label>
                            <textarea class="form-control" id="additional_notes" name="additional_notes"></textarea>
                            <span class="text-danger" id="additionalNotesError"></span>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn mt-4 px-4 br_8 text_transform_none" id="submitBtn"
                                style="text-transform: none !important;">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Duplicate Submission Modal -->
    <div class="modal-overlay" id="duplicateModal">
        <div class="modal-content">
            <h4>Duplicate Submission Warning</h4>
            <p>You have already submitted this form for this product type and date. Do you want to resubmit the form?
            </p>
            <div class="modal-buttons">
                <button type="button" class="btn btn-cancel" id="modalCancelBtn">Cancel</button>
                <button type="button" class="btn" id="modalYesBtn">Yes, Resubmit</button>
            </div>
        </div>
    </div>

    <!-- Waiting List Modal -->
    <div class="modal-overlay waiting-list" id="waitingListModal">
        <div class="modal-content">
            <h4>⚠️ Registration Full</h4>
            <p>Submissions for this date and product type are currently full.</p>
            <p><strong>Would you like to join the waiting list?</strong></p>
            <p style="font-size: 14px; color: #666;">We will contact you if a spot becomes available.</p>
            <div class="modal-buttons">
                <button type="button" class="btn btn-waiting-no" id="waitingNoBtn">No, Thanks</button>
                <button type="button" class="btn btn-waiting-yes" id="waitingYesBtn">Yes, Join Waiting List</button>
            </div>
        </div>
    </div>

    <!-- Already in Waiting List Modal -->
    <div class="modal-overlay already-waiting" id="alreadyWaitingModal">
        <div class="modal-content">
            <h4>🚫 Already in Waiting List</h4>
            <p>You are already in the waiting list for this product type and date.</p>
            <p><strong>You cannot submit another waiting list request.</strong></p>
            <p style="font-size: 14px; color: #666;">We will contact you when a spot becomes available.</p>
            <div class="modal-buttons">
                <button type="button" class="btn btn-ok-understood" id="alreadyWaitingOkBtn">OK, Understood</button>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {

        let currentMeetingLink = '';
        let isDuplicateConfirmed = false;

        console.log('Script loaded');

        // Validation on input for other fields
        $('#username, #phone, #email, #additional_notes').on('input', function () {
            let field = $(this).attr('name');
            let value = $(this).val();
            validateField(field, value);
        });

        function validateField(field, value) {
            let data = {};
            data[field] = value;
            data['_token'] = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("witness.validate") }}',
                method: 'POST',
                data: data,
                success: function (response) {
                    if (response.success) {
                        $('#' + field + 'Error').text('');
                    } else {
                        if (response.errors[field]) {
                            $('#' + field + 'Error').text(response.errors[field][0]);
                        }
                    }
                },
                error: function (response) {
                    console.error('Error:', response);
                }
            });
        }

        // Handle product type change
        $('#product_type').on('change', function () {
            let productTypeId = $(this).val();

            isDuplicateConfirmed = false;

            $('#preferred_date').val('');
            $('#preferred_date_value').val('');
            $('#dateMessage').hide().text('');
            $('#productTypeError').text('');
            $('#preferredDateError').text('');
            $('#submitBtn').prop('disabled', false);
            currentMeetingLink = '';

            if (!productTypeId) {
                $('#preferred_date').attr('placeholder', 'Select product type first');
                return;
            }

            $('#preferred_date').val('Loading...').prop('disabled', true);

            $.ajax({
                url: '{{ route("witness.getPreferredDate") }}',
                method: 'POST',
                data: {
                    product_type_id: productTypeId,
                    _token: $('input[name="_token"]').val()
                },
                success: function (response) {
                    if (response.success) {
                        $('#preferred_date').val(response.formatted_date);
                        $('#preferred_date_value').val(response.preferred_date);
                        $('#preferred_date').prop('disabled', true);
                        $('#submitBtn').prop('disabled', false);
                        currentMeetingLink = response.meeting_link || '';
                    } else {
                        $('#preferred_date').val('');
                        $('#preferred_date').attr('placeholder', 'No date available');
                        $('#dateMessage').text(response.message).show();
                        $('#submitBtn').prop('disabled', true);
                    }
                },
                error: function (response) {
                    console.error('Error:', response);
                    $('#preferred_date').val('');
                    $('#preferred_date').attr('placeholder', 'Error loading date');
                    $('#dateMessage').text('Error loading date. Please try again.').show();
                    $('#submitBtn').prop('disabled', true);
                }
            });
        });

        // Function to check for duplicate submission
        function checkDuplicateSubmission() {
            return new Promise((resolve, reject) => {
                let email = $('#email').val();
                let productType = $('#product_type').val();
                let preferredDate = $('#preferred_date_value').val();

                $.ajax({
                    url: '{{ route("witness.checkDuplicate") }}',
                    method: 'POST',
                    data: {
                        email: email,
                        product_type: productType,
                        preferred_date: preferredDate,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        if (response.success && response.is_duplicate) {
                            resolve(true);
                        } else {
                            resolve(false);
                        }
                    },
                    error: function (response) {
                        console.error('Error checking duplicate:', response);
                        resolve(false);
                    }
                });
            });
        }

        // Function to check capacity
        function checkCapacity() {
            return new Promise((resolve, reject) => {
                let productType = $('#product_type').val();
                let preferredDate = $('#preferred_date_value').val();

                $.ajax({
                    url: '{{ route("witness.checkCapacity") }}',
                    method: 'POST',
                    data: {
                        product_type: productType,
                        preferred_date: preferredDate,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        console.log('Capacity check:', response);
                        resolve(response);  // Return the full response object instead of true/false
                    },
                    error: function (response) {
                        console.error('Error checking capacity:', response);
                        resolve({ success: false, is_full: false });  // Fallback response on error
                    }
                });
            });
        }

        // Function to check if already in waiting list
        function checkWaitingList() {
            return new Promise((resolve, reject) => {
                let email = $('#email').val();
                let productType = $('#product_type').val();
                let preferredDate = $('#preferred_date_value').val();

                $.ajax({
                    url: '{{ route("witness.checkWaitingList") }}',
                    method: 'POST',
                    data: {
                        email: email,
                        product_type: productType,
                        preferred_date: preferredDate,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        console.log('Waiting list check:', response);
                        if (response.success && response.is_in_waiting_list) {
                            resolve(true);
                        } else {
                            resolve(false);
                        }
                    },
                    error: function (response) {
                        console.error('Error checking waiting list:', response);
                        resolve(false);
                    }
                });
            });
        }

        // Duplicate modal - Yes button
        $('#modalYesBtn').on('click', function () {
            console.log('Duplicate modal - Yes clicked');
            isDuplicateConfirmed = true;
            $('#duplicateModal').removeClass('active');
            $('#witnessForm').submit();
        });

        // Duplicate modal - Cancel button
        $('#modalCancelBtn').on('click', function () {
            console.log('Duplicate modal - Cancel clicked');
            $('#duplicateModal').removeClass('active');
            $('#product_type').val('');
            $('#preferred_date').val('');
            $('#preferred_date_value').val('');
            $('#preferred_date').attr('placeholder', 'Select product type first');
            currentMeetingLink = '';
            isDuplicateConfirmed = false;
            $('#productTypeError').text('');
            $('#preferredDateError').text('');
            $('#dateMessage').hide().text('');
        });

        // Waiting List modal - Yes button
        $('#waitingYesBtn').on('click', function () {
            console.log('Waiting list - Yes clicked');
            $('#waitingListModal').removeClass('active');

            let formData = $('#witnessForm').serializeArray();
            formData = formData.filter(item => item.name !== 'preferred_date');
            formData.push({
                name: 'preferred_date',
                value: $('#preferred_date_value').val()
            });

            console.log('Submitting to waiting list:', formData);

            $.ajax({
                url: '{{ route("witness.storeWaitingList") }}',
                method: 'POST',
                data: $.param(formData),
                success: function (response) {
                    console.log('Waiting list response:', response);
                    if (response.success) {
                        let alertHtml = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 10000; min-width: 300px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <strong>✓ Added to Waiting List!</strong><br>
                                ${response.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `;
                        $('body').append(alertHtml);

                        setTimeout(function () {
                            $('.alert').alert('close');
                        }, 5000);

                        $('#witnessForm')[0].reset();
                        $('#product_type').val('');
                        $('#preferred_date').val('');
                        $('#preferred_date_value').val('');
                        $('#preferred_date').attr('placeholder', 'Select product type first');
                        currentMeetingLink = '';
                        isDuplicateConfirmed = false;
                    }
                },
                error: function (response) {
                    console.error('Waiting list error:', response);
                    toastr.error('Failed to add to waiting list. Please try again.');
                }
            });
        });

        // Waiting List modal - No button
        $('#waitingNoBtn').on('click', function () {
            console.log('Waiting list - No clicked');
            $('#waitingListModal').removeClass('active');
            $('#product_type').val('');
            $('#preferred_date').val('');
            $('#preferred_date_value').val('');
            $('#preferred_date').attr('placeholder', 'Select product type first');
            currentMeetingLink = '';
            isDuplicateConfirmed = false;
            toastr.info('Form submission cancelled.');
        });

        // Already in Waiting List modal - OK button
        $('#alreadyWaitingOkBtn').on('click', function () {
            console.log('Already waiting - OK clicked');
            $('#alreadyWaitingModal').removeClass('active');
            $('#product_type').val('');
            $('#preferred_date').val('');
            $('#preferred_date_value').val('');
            $('#preferred_date').attr('placeholder', 'Select product type first');
            currentMeetingLink = '';
            isDuplicateConfirmed = false;
        });

        // Form submission with UPDATED FLOW
        $('#witnessForm').on('submit', async function (e) {
            e.preventDefault();
            console.log('=== FORM SUBMISSION STARTED ===');
            $('.text-danger').text('');
            toastr.clear();

            // STEP 1: Check if already submitted (duplicate check) - ONLY if not already confirmed
            if (!isDuplicateConfirmed) {
                console.log('STEP 1: Checking for duplicates...');
                let isDuplicate = await checkDuplicateSubmission();
                console.log('Is duplicate?', isDuplicate);

                if (isDuplicate) {
                    console.log('DUPLICATE FOUND - Showing duplicate modal');
                    $('#duplicateModal').addClass('active');
                    return; // Stop here, wait for user decision
                }
            }

            // STEP 2: If duplicate confirmed, SKIP capacity and waiting list checks - submit directly
            if (isDuplicateConfirmed) {
                console.log('DUPLICATE CONFIRMED - Skipping capacity checks, submitting directly...');
                isDuplicateConfirmed = false; // Reset flag
                submitFormDirectly();
                return;
            }

            // STEP 3: For new submissions, check capacity
            console.log('STEP 3: Checking capacity...');
            let capacityResponse = await checkCapacity();
            console.log('Capacity response:', capacityResponse);

            if (capacityResponse.success && capacityResponse.is_full) {
                // STEP 4: Capacity full - check waiting list
                console.log('CAPACITY FULL - STEP 4: Checking waiting list...');
                let isInWaitingList = await checkWaitingList();
                console.log('Already in waiting list?', isInWaitingList);

                if (isInWaitingList) {
                    console.log('ALREADY IN WAITING LIST - Showing already waiting modal');
                    $('#alreadyWaitingModal').addClass('active');
                    return; // Stop submission
                } else {
                    console.log('NOT IN WAITING LIST - Showing waiting list modal');
                    // Update modal text dynamically with capacity and current count
                    $('#waitingListModal .modal-content p').first().text(
                        `Submissions for this date and product type are currently full(${capacityResponse.current_count}/${capacityResponse.capacity} spots taken).`
                    );
                    $('#waitingListModal').addClass('active');
                    return; // Stop submission
                }
            }

            // STEP 5: All checks passed, submit the form
            console.log('STEP 5: All checks passed - Submitting form...');
            submitFormDirectly();
        });

        // Helper function to submit the form (used in both duplicate and normal flows)
        function submitFormDirectly() {
            let formData = $('#witnessForm').serializeArray();
            formData = formData.filter(item => item.name !== 'preferred_date');
            formData.push({
                name: 'preferred_date',
                value: $('#preferred_date_value').val()
            });
            formData.push({
                name: 'meeting_link',
                value: currentMeetingLink
            });

            console.log('Submitting form:', formData);

            $.ajax({
                url: '{{ route("witness.store") }}',
                method: 'POST',
                data: $.param(formData),
                success: function (response) {
                    console.log('SUCCESS:', response);
                    if (response.success) {
                        toastr.success('Form submitted successfully!');
                        $('#witnessForm')[0].reset();
                        $('#preferred_date').attr('placeholder', 'Select product type first');
                        $('#submitBtn').prop('disabled', false);
                        currentMeetingLink = '';
                    }
                },
                error: function (xhr, status, error) {
                    console.log('=== SUBMISSION ERROR ===');
                    console.log('XHR:', xhr);
                    console.log('Response:', xhr.responseJSON);

                    try {
                        var response = xhr.responseJSON;

                        // Check for capacity full (backend validation as fallback)
                        if (response && response.capacity_full === true) {
                            console.log('Backend says capacity full');
                            // Check waiting list status
                            checkWaitingList().then(function (isInWaitingList) {
                                if (isInWaitingList) {
                                    $('#alreadyWaitingModal').addClass('active');
                                } else {
                                    $('#waitingListModal').addClass('active');
                                }
                            });
                            return;
                        }

                        if (response && response.errors) {
                            let errors = response.errors;
                            if (errors.username) {
                                $('#usernameError').text(errors.username[0]);
                                toastr.error(errors.username[0]);
                            }
                            if (errors.phone) {
                                $('#phoneError').text(errors.phone[0]);
                                toastr.error(errors.phone[0]);
                            }
                            if (errors.email) {
                                $('#emailError').text(errors.email[0]);
                                toastr.error(errors.email[0]);
                            }
                            if (errors.product_type) {
                                $('#productTypeError').text(errors.product_type[0]);
                                toastr.error(errors.product_type[0]);
                            }
                            if (errors.preferred_date) {
                                $('#preferredDateError').text(errors.preferred_date[0]);
                                toastr.error(errors.preferred_date[0]);
                            }
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                }
            });
        }
    });
</script>

@endsection