// Preview Video Before Upload
function previewVideo(event) {
    const file = event.target.files[0];
    const videoError = document.getElementById('video-error');
    const videoPreview = document.getElementById('videoPreview');
    const uploadButton = document.getElementById('uploadButton');
    const maxSizeMB = 20; // Max file size in MB
    const maxSizeBytes = maxSizeMB * 1024 * 1024; // Convert MB to bytes

    // Reset previous error and preview
    videoError.style.display = 'none';
    videoError.textContent = '';
    videoPreview.src = '';
    document.querySelector('.video-preview').style.display = 'none';
    uploadButton.disabled = true;

    if (file) {
        // Check file size
        if (file.size > maxSizeBytes) {
            videoError.textContent = `Validation Error: Video file size must be less than ${maxSizeMB} MB.`;
            videoError.style.display = 'block';
            event.target.value = ''; // Clear the input
            return;
        }

        // If file size is valid, show preview
        videoPreview.src = URL.createObjectURL(file);
        document.querySelector('.video-preview').style.display = 'block';
        uploadButton.disabled = false; // Enable upload button
    }
}

// Handle Drag and Drop
const dropArea = document.getElementById('dropArea');
dropArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropArea.classList.add('drag-over');
});
dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('drag-over');
});
dropArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dropArea.classList.remove('drag-over');
    const fileInput = document.getElementById('video');
    fileInput.files = event.dataTransfer.files;
    previewVideo({
        target: fileInput
    });
});

// Preview Image Before Upload
function previewImage(input, currentImgId, previewImgId) {
    const currentImg = document.getElementById(currentImgId);
    const previewImg = document.getElementById(previewImgId);
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            currentImg.style.display = 'none';
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

const video = document.getElementById("customVideo");
// Attempt to play the video programmatically
video.play().catch((error) => {
    console.log("Autoplay was prevented, attempting to play again on click.");
});
// Toggle play/pause on click
video.addEventListener("click", function () {
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
});