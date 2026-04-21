$(function () {
    $("#sortable").sortable({
        update: function (event, ui) {
            var order = $(this).sortable('toArray', {
                attribute: 'data-id'
            });
            saveOrder(order);
        }
    });
    $("#sortable").disableSelection();
});

function saveOrder(order) {
    $.ajax({
        url: 'setDubaiTeamOrder', // Your route to handle the order saving
        method: 'POST',
        data: {
            order: order,
            _token: '{{ csrf_token() }}' // Include CSRF token for security
        },
        success: function (response) {
            alert('Order saved successfully!');
        },
        error: function (xhr) {
            alert('Error saving order: ' + xhr.responseText);
        }
    });
}
const projectPicInput = document.getElementById('profilePicInput');
const errorMessage = document.getElementById('errorMessage');
const allowedFileTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

projectPicInput.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        if (allowedFileTypes.includes(file.type)) {
            errorMessage.style.display = 'none';
            // Here you can handle the valid file, e.g., prepare it for upload
            console.log('Valid file selected:', file.name);
        } else {
            errorMessage.style.display = 'block';
            event.target.value = ''; // Reset the input
        }
    }
});
const projectPicInput1 = document.getElementById('editProfilePicInput'); // Corrected to match the HTML id
const editerrorMessage = document.getElementById('editerrorMessage');
const allowedFileTypes1 = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

projectPicInput1.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        if (allowedFileTypes1.includes(file.type)) {
            editerrorMessage.style.display = 'none';
            console.log('Valid file selected:', file.name);
        } else {
            editerrorMessage.style.display = 'block';
            event.target.value = ''; // Reset the input
        }
    }
});