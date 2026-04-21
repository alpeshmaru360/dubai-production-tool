$(document).ready(function () {
    $('#username, #phone, #email, #suggestions').on('input', function () {
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
            success: function (response) {
                if (response.success) {
                    $('#' + field + 'Error').text(''); // Clear error message
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

    $('#feedbackForm').on('submit', function (e) {
        e.preventDefault();
        $('.text-danger').text(''); // Clear previous errors
        toastr.clear();

        $.ajax({
            url: '{{ route("feedback.store") }}', // Correct store route
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    toastr.success('Feedback submitted successfully!', 'Success', {
                        timeOut: 3000,
                        positionClass: 'toast-top-right' // Change position as needed
                    });
                    $('#feedbackForm')[0].reset(); // Reset form
                }
            },
            error: function (response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    let errors = response.responseJSON.errors;
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
                    if (errors.suggestions) {
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
