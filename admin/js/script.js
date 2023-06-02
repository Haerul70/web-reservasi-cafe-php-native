let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.addEventListener('click', () => {
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
});

window.addEventListener('scroll', () => {
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
});

document.querySelector('#close-edit').onclick = () => {
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = './web-reservasi-resto/admin/admin.php';
};

const checkboxes = document.querySelectorAll('.ready-checkbox');
checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', function () {
        this.closest('form').submit();
    });
});
