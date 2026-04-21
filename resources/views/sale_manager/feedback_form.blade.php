@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/feedback_form.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<style type="text/css">

</style>

<div class="dubai_production_section bg-white phone_responsive">
    <!-- First Parallax Section -->
    <a href="{{route('SaleManagerDashboard')}}" class="btn btn-primary custom-back">
        <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>
        Back
    </a>

    <div class="user_registration_section">
        <div class="container">
            <div class="body-content">
                <div class="formm p-4 rounded shadow-lg bg-white">
                    <h3 class="text-center mb-4">Feedback Form</h3>

                    <form id="feedbackForm" method="post">
                        @csrf

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <span class="text-danger mandatory"></span>
                            <input type="text" class="form-control" id="username" name="username" value="{{Auth::user()->name}}">
                            <span class="text-danger" id="usernameError"></span>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <span class="text-danger mandatory"></span>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}">
                            <span class="text-danger" id="phoneError"></span>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <span class="text-danger mandatory"></span>
                            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
                            <span class="text-danger" id="emailError"></span>
                        </div>

                        <!-- Suggestions -->
                        <div class="form-group">
                            <label for="suggestions">Suggestions</label>
                            <span class="text-danger mandatory"></span>
                            <textarea class="form-control" id="suggestions" name="suggestions" rows="5"></textarea>
                            <span class="text-danger" id="suggestionsError"></span>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn mt-4 px-4">Submit Feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('#username, #phone, #email, #suggestions').on('input', function() {
            let field = $(this).attr('name');
            let value = $(this).val();
            validateField(field, value);
        });

        function validateField(field, value) {
            let data = {};
            data[field] = value;
            data['_token'] = $('input[name="_token"]').val(); // CSRF token

            $.ajax({
                url: '{{ route("feedback.validate") }}', // Correct validation route
                method: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#' + field + 'Error').text(''); // Clear error message
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

        $('#feedbackForm').on('submit', function(e) {
            e.preventDefault();
            $('.text-danger').text(''); // Clear previous errors
            toastr.clear();

            $.ajax({
                url: '{{ route("feedback.store") }}', // Correct store route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success('Feedback submitted successfully!', 'Success', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right' // Change position as needed
                        });
                        $('#feedbackForm')[0].reset(); // Reset form
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        if (errors.username){
                            $('#usernameError').text(errors.username[0]);
                            toastr.error(errors.username[0]);
                        } 
                        if (errors.phone){
                            $('#phoneError').text(errors.phone[0]);
                            toastr.error(errors.phone[0]);
                        } 
                        if (errors.email){
                            $('#emailError').text(errors.email[0]);
                            toastr.error(errors.email[0]);
                        } 
                        if (errors.suggestions){
                            $('#suggestionsError').text(errors.suggestions[0]);
                            toastr.error(errors.suggestions[0]);
                        } 
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.', 'Error', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right' // Change position as needed
                        });
                        console.error(response);
                    }
                }
            });
        });
    });
</script>
@endsection