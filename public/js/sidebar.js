const openBtn = document.getElementById('open-btn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

openBtn.addEventListener('click', function() {
    sidebar.classList.toggle('open-sidebar');
    overlay.classList.toggle('active');
});

overlay.addEventListener('click', function() {
    sidebar.classList.remove('open-sidebar');
    overlay.classList.remove('active');
});