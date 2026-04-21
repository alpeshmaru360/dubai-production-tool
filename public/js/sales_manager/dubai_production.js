// Get modal elements
var modal = document.getElementById('imageModal');
var modalImg = document.getElementById('modalImage');
var closeBtn = document.getElementById('close-img'); // Updated to use 'id'

// Add click event for each success image
document.querySelectorAll('.success-image').forEach(img => {
    img.addEventListener('click', function() {
        modal.style.display = 'block';
        modalImg.src = this.src;
    });
});

// Close the modal when the 'X' is clicked
if (closeBtn) {
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
}

// Close the modal when clicking anywhere outside the image
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Handling commitment buttons
    document.querySelectorAll('.commitment-button').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            event.preventDefault();
            const label = this.getAttribute('data-lable');
            document.getElementById('exampleModalLabel1').textContent = label;
            document.getElementById('exampleModalLabel2').textContent = label;
            document.getElementById('exampleModalLabel3').textContent = label;
            document.getElementById('exampleModalLabel4').textContent = label;
            document.getElementById('exampleModalLabel5').textContent = label;
            document.getElementById('exampleModalLabel6').textContent = label;
            document.getElementById('exampleModalLabel7').textContent = label;
            document.getElementById('exampleModalLabel8').textContent = label;
        });
    });

    // Handling dynamic buttons
    document.querySelectorAll('.dynamic-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const label = this.getAttribute('data-lable');
            document.getElementById('exampleModalLabel1').textContent = label;
            document.getElementById('exampleModalLabel2').textContent = label;
            document.getElementById('exampleModalLabel3').textContent = label;
            document.getElementById('exampleModalLabel4').textContent = label;
            document.getElementById('exampleModalLabel5').textContent = label;
            document.getElementById('exampleModalLabel6').textContent = label;
            document.getElementById('exampleModalLabel7').textContent = label;
            document.getElementById('exampleModalLabel8').textContent = label;
        });
    });
});