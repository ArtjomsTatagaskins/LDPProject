document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }
});
function toggleMenu() {
    const menu = document.getElementById('menu');
    const menuToggle = document.querySelector('.menu-toggle');

    menu.classList.toggle('open');

    const openImg = menuToggle.querySelector('.open');
    const closeImg = menuToggle.querySelector('.close');

    if (menu.classList.contains('open')) {
        openImg.style.display = 'none';
        closeImg.style.display = 'inline-block';
    } else {
        openImg.style.display = 'inline-block';
        closeImg.style.display = 'none';
    }
}
