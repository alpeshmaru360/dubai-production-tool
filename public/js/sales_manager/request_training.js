$(document).ready(function () {
    // Attach event listeners to input fields for live validation
    $('#username, #phone, #email, #description').on('input', function () {
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
            success: function (response) {
                if (response.success) {
                    $('#' + field + 'Error').text(''); // Clear the error message if validation passed
                } else {
                    if (response.errors[field]) {
                        $('#' + field + 'Error').text(response.errors[field][0]); // Show validation error
                    }
                }
            },
            error: function (response) {
                console.error('Error:', response);
            }
        });
    }

    // Existing form submission logic
    $('#trainingForm').on('submit', function (e) {
        e.preventDefault();
        $('.text-danger').text(''); // Clear previous error messages
        toastr.clear();

        $.ajax({
            url: '{{ route("training.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    toastr.success('Request Training Form submitted successfully!'); // Use Toastr for success notification
                    $('#trainingForm')[0].reset(); // Reset the form
                }
            },
            error: function (response) {
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