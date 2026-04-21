// document.addEventListener("DOMContentLoaded", function () {
//     @if (session('success'))
//         var toastEl = document.getElementById('successToast');
//     var toast = new bootstrap.Toast(toastEl, { delay: 5000 }); // Show for 5 seconds
//     toast.show();
//     @endif
// });
document.addEventListener('DOMContentLoaded', function() {
        const buttonContainer = document.getElementById('button-fields-container');
        let fieldCount = buttonContainer.querySelectorAll('.input-field-group').length;

        // Function to add more input fields dynamically
        document.getElementById('add-more-btn').addEventListener('click', function() {
            fieldCount++;

            // Create a new div for the new fields
            let newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('mb-3', 'input-field-group', 'd-flex', 'gap-2', 'align-items-center', 'w-75');

            // Add new input fields for button text and link
            newFieldGroup.innerHTML = `
            <div class="d-flex gap-2">
                <input type="text" name="button_text[]" id="button_text_${fieldCount}" class="form-control" placeholder="Enter button text" required>
            </div>
            <div class="d-flex gap-2">
                <input type="url" name="button_link[]" id="button_link_${fieldCount}" class="form-control" placeholder="Enter button link" required>
            </div>
            <button type="button" class="remove-btn btn btn-danger">&#10006;</button>
        `;

            // Append the new fields to the container
            buttonContainer.appendChild(newFieldGroup);

            // Add event listener to the new remove button
            addRemoveButtonListener(newFieldGroup.querySelector('.remove-btn'));
        });

        // Function to add event listener to remove buttons
        function addRemoveButtonListener(button) {
            button.addEventListener('click', function() {
                this.closest('.input-field-group').remove();
            });
        }

        // Add event listeners to existing remove buttons
        buttonContainer.querySelectorAll('.remove-btn').forEach(addRemoveButtonListener);
    });