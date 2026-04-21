var video = document.getElementById("customVideo");

// Set the volume to 10% (0.1)
video.volume = 0.02;

// Optional: Play the video on page load (if you want autoplay)
video.play();
// Add click event to toggle play/pause
video.addEventListener("click", function () {
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
});