document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    
    sidebarItems.forEach(item => {
        const hideMenu = item.querySelector('.hide-menu');
        if (hideMenu && hideMenu.textContent.trim() === 'Gurukul') {
            const gurukulLink = item.querySelector('.sidebar-link');
            const submenu = item.querySelector('.sidebar-submenu');
            const chevron = item.querySelector('.chevron i');

            if (gurukulLink && submenu && chevron) {
                gurukulLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
                    chevron.classList.toggle('ti-chevron-right');
                    chevron.classList.toggle('ti-chevron-down');
                });
            }
        }
    });
});