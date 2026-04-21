jQuery(document).ready(function () {
    jQuery('#feedback_form').DataTable({
        paging: true,
        pageLength: 10,
        lengthMenu: [2, 5, 10, 25, 50, 100],
        ordering: false
    });

    // Attach event to dynamically load and show full suggestion in the modal
    jQuery(document).on('click', '.read-more', function (event) {
        event.preventDefault();
        const fullSuggestion = jQuery(this).data('suggestion');
        jQuery('#fullSuggestionContent').text(fullSuggestion);

        // Initialize and show the modal
        const suggestionModal = new bootstrap.Modal(document.getElementById('suggestionModal'));
        suggestionModal.show();
    });
});