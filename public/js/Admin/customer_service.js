$(document).ready(function () {
    // Initialize DataTable
    $('#customer-service-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthMenu: [5, 10, 25, 50, 100],
    });

    // Attach click event to "Read More" links
    $('.read-more').on('click', function () {
        const message = $(this).data('message'); // Get the full message from data attribute
        $('#fullMessage').text(message); // Set the message text in the modal
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone_number');

    phoneInput.addEventListener('input', function (e) {
        // Remove any character that is not a number or '+'
        let cleanedValue = this.value.replace(/[^\d+]/g, '');

        // Ensure only one '+' at the beginning
        if (cleanedValue.startsWith('+')) {
            cleanedValue = '+' + cleanedValue.substring(1).replace(/\+/g, '');
        } else {
            cleanedValue = cleanedValue.replace(/\+/g, '');
        }

        // Update the input value
        this.value = cleanedValue;
    });

    // Prevent pasting of invalid characters
    phoneInput.addEventListener('paste', function (e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const cleanedPastedText = pastedText.replace(/[^\d+]/g, '');

        // Insert the cleaned pasted text at the cursor position
        const start = this.selectionStart;
        const end = this.selectionEnd;
        const currentValue = this.value;
        this.value = currentValue.substring(0, start) + cleanedPastedText + currentValue.substring(end);

        // Move the cursor to the end of the inserted text
        this.setSelectionRange(start + cleanedPastedText.length, start + cleanedPastedText.length);
    });
});