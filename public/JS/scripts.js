var navbarToggle = document.getElementById('navbar-toggle');
var navbarMenu = document.getElementById('navbar-menu');

navbarToggle.addEventListener('click', function() {
  navbarMenu.classList.toggle('open');
});