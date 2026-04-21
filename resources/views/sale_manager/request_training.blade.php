@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/request_training.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


<div class="user_registration_section phone_responsive">
    <a href="{{ route('SaleManagerDashboard') }}" class="btn btn-primary custom-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>
        Back
    </a>
    <div class="container">

        <div class="body-content mt-3">

            <div class="formm p-4 rounded shadow-lg bg-white">
                <h3 class="text-center mb-4">Request Training Form</h3>
                <form id="trainingForm" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <span class="text-danger mandatory"></span>
                        <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->name }}">
                        <span class="text-danger" id="usernameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <span class="text-danger mandatory"></span>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                        <span class="text-danger" id="phoneError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <span class="text-danger mandatory"></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        <span class="text-danger" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label>Select Training Type</label>
                        <span class="text-danger mandatory"></span>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="training_type" id="pricing_tool" value="Pricing tool" checked>
                                <label class="form-check-label" for="pricing_tool">Pricing tool</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="training_type" id="orders_tracking" value="Orders tracking">
                                <label class="form-check-label" for="orders_tracking">Orders tracking</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="training_type" id="product_training" value="Product training">
                                <label class="form-check-label" for="product_training">Product training</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="training_type" id="test_facility" value="Test facility">
                                <label class="form-check-label" for="test_facility">Test facility</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="training_type" id="other" value="Other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <span class="text-danger mandatory"></span>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Provide details about your selected training type..."></textarea>
                        <span class="text-danger" id="descriptionError"></span>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn mt-4 px-4">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
<script src="https://splidejs.com/dist/js/splide.min.js"></script>

<script>
    $(document).ready(function() {
        // Attach event listeners to input fields for live validation
        $('#username, #phone, #email, #description').on('input', function() {
            let field = $(this).attr('name');
            let value = $(this).val();
            validateField(field, value);
        });

        // Function to validate fields dynamically
        function validateField(field, value) {
            let data = {};
            data[field] = value;
            data['_token'] = $('input[name="_token"]').val(); // CSRF token

            $.ajax({
                url: '{{ route("training.validate") }}',
                method: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#' + field + 'Error').text(''); // Clear the error message if validation passed
                    } else {
                        if (response.errors[field]) {
                            $('#' + field + 'Error').text(response.errors[field][0]); // Show validation error
                        }
                    }
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        }

        // Existing form submission logic
        $('#trainingForm').on('submit', function(e) {
            e.preventDefault();
            $('.text-danger').text(''); // Clear previous error messages
            toastr.clear();

            $.ajax({
                url: '{{ route("training.store") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success('Request Training Form submitted successfully!'); // Use Toastr for success notification
                        $('#trainingForm')[0].reset(); // Reset the form
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        if (errors.username) {
                            $('#usernameError').text(errors.username[0]);
                            toastr.error(errors.username[0]); // Use Toastr for error notification
                        }
                        if (errors.phone) {
                            $('#phoneError').text(errors.phone[0]);
                            toastr.error(errors.phone[0]); // Use Toastr for error notification
                        }
                        if (errors.email) {
                            $('#emailError').text(errors.email[0]);
                            toastr.error(errors.email[0]); // Use Toastr for error notification
                        }
                        if (errors.description) {
                            $('#descriptionError').text(errors.description[0]);
                            toastr.error(errors.description[0]); // Use Toastr for error notification
                        }
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.'); // Use Toastr for error notification
                        console.error(response);
                    }
                }
            });
        });
    });
</script>
@endsection