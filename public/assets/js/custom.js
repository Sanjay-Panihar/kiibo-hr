document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    
    sidebarItems.forEach(item => {
        const link = item.querySelector('.sidebar-link');
        const submenu = item.querySelector('.sidebar-submenu');
        const chevron = item.querySelector('.chevron i');

        if (link && submenu && chevron) {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Toggle submenu visibility
                submenu.style.display = submenu.style.display === 'none' || submenu.style.display === '' ? 'block' : 'none';

                // Toggle chevron icon
                chevron.classList.toggle('ti-chevron-right');
                chevron.classList.toggle('ti-chevron-down');

                // Close other open submenus (optional)
                closeOtherSubmenus(item);
            });
        }
    });
});

// Function to close other open submenus
function closeOtherSubmenus(currentItem) {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    sidebarItems.forEach(item => {
        if (item !== currentItem) {
            const submenu = item.querySelector('.sidebar-submenu');
            const chevron = item.querySelector('.chevron i');
            if (submenu && chevron) {
                submenu.style.display = 'none';
                chevron.classList.remove('ti-chevron-down');
                chevron.classList.add('ti-chevron-right');
            }
        }
    });
}

function showErrors(errors) {
    for (let field in errors) {
        if (errors.hasOwnProperty(field)) {
            document.getElementById(field + '_error').textContent = errors[field][0];
        }
    }
}
function clearErrors() {
    $('.text-danger').text('');
}