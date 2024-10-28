document.addEventListener('DOMContentLoaded', function() {
    const profileContainer = document.getElementById('profileContainer');
    const profileImage = document.getElementById('profileImage');
    const uploadOverlay = document.getElementById('uploadOverlay');
    const fileInput = document.getElementById('fileInput');

    profileContainer.addEventListener('mouseenter', () => {
        uploadOverlay.style.opacity = '1';
    });

    profileContainer.addEventListener('mouseleave', () => {
        uploadOverlay.style.opacity = '0';
    });

    profileContainer.addEventListener('click', () => {
        fileInput.click();
    });

    function uploadProfilePicture(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    fileInput.addEventListener('change', uploadProfilePicture);
});