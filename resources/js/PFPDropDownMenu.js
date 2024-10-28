document.addEventListener('DOMContentLoaded', function () {
    const profileCircle = document.querySelector('.profile-circle');
    const menu = document.getElementById('profileMenu');

    if (profileCircle) {
        profileCircle.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    }

    document.addEventListener('click', function (event) {
        if (!profileCircle.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
});
