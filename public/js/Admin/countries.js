document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addCountryForm');
    const errorMessage = document.getElementById('countryErrorMessage');
    const countryNameInput = document.getElementById('country_name');
    const saveButton = document.getElementById('saveCountryBtn');

    saveButton.addEventListener('click', function (event) {
        // Prevent the default button behavior
        event.preventDefault();

        // Check if a country has been selected
        if (!countryNameInput.value) {
            // Show the error message
            errorMessage.classList.remove('d-none');
            // Scroll to the top of the modal body if necessary
            errorMessage.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        } else {
            // Hide the error message (in case it was shown before)
            errorMessage.classList.add('d-none');
            // Submit the form
            form.submit();
        }
    });

    // Optional: Hide the error message when the user starts selecting a country
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('countrychange', function () {
        errorMessage.classList.add('d-none');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // DataTable initialization
    $('#countries_table').DataTable({
        paging: true,
        pageLength: 10,
        ordering: false
    });

    // const input = document.querySelector("#phone");
    // const iti = window.intlTelInput(input, {
    //     separateDialCode: true,
    //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    // });

    // input.addEventListener("countrychange", function() {
    //     const countryData = iti.getSelectedCountryData();
    //     const countryName = countryData.name;
    //     const dialCode = `+${countryData.dialCode}`;

    //     document.querySelector("#displayCountry").value = `${countryName} (${dialCode})`;
    //     document.querySelector("#country_name").value = countryName;
    //     document.querySelector("#country_code").value = dialCode;
    // });

    const input = document.querySelector("#phone");
    if (input) {
        const iti = window.intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Function to update country display
        function updateCountryDisplay() {
            const countryData = iti.getSelectedCountryData();
            const countryName = countryData.name;
            const dialCode = `+${countryData.dialCode}`;

            document.querySelector("#displayCountry").value = `${countryName} (${dialCode})`;
            document.querySelector("#country_name").value = countryName;
            document.querySelector("#country_code").value = dialCode;
        }

        // Trigger update on country change
        input.addEventListener("countrychange", updateCountryDisplay);

        // Trigger update on page load
        updateCountryDisplay();
    }


    // Handle delete button click
    // document.querySelectorAll('.btn-delete').forEach(button => {
    //     button.addEventListener('click', function() {
    //         const deleteUrl = this.getAttribute('data-url');
    //         const deleteForm = document.getElementById('deleteForm');
    //         deleteForm.setAttribute('action', deleteUrl);

    //         // Show the confirmation modal
    //         const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    //         deleteModal.show();
    //     });
    // });

    // Handle delete button click
    const table = document.getElementById('countries_table');

    table.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-delete')) {
            const deleteUrl = event.target.getAttribute('data-url');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.setAttribute('action', deleteUrl);

            // Show the confirmation modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        }
    });
});