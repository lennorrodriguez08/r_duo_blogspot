document.addEventListener('DOMContentLoaded', function() {

    // SCROLL TO TOP
    const scrollToTop = document.querySelector('.scroll-to-top');

    window.addEventListener('scroll', function (e) {

        if (window.pageYOffset > 900) {
            scrollToTop.classList.add('scroll-active');
        }   else {
            scrollToTop.classList.remove('scroll-active');
        }

    });

    // NAVBAR
    const toggleItem = document.querySelector('.toggle-item');
    const nav = document.querySelector('nav');

    nav.addEventListener('click', function(e) {

        if (e.target.classList.contains('fa-bars')) {
            e.target.className = 'fas fa-times';
            toggleItem.style.top = '84px';

        }  else if (e.target.classList.contains('fa-times')) {
            e.target.className = 'fas fa-bars';
            toggleItem.style.top = '-350px';
        }
    });


    // FOR SESSION IN NAVBAR
    const adminToggleTarget = document.querySelector('.admin-toggle-target');
    const adminToggleItem = document.querySelector('.admin-toggle ul');

    adminToggleTarget.addEventListener('click', function(e) {
        if (e.target.classList.contains('admin-toggle-target')) {
            adminToggleTarget.className = 'admin-toggle-target-1';
            adminToggleItem.style.display = 'block';
        }   else if (e.target.classList.contains('admin-toggle-target-1')) {
            adminToggleTarget.className = 'admin-toggle-target';
            adminToggleItem.style.display = 'none';
        }
        
    });

    // FOR MODAL IN NAVBAR SESSION 

    const updateProfileModal = document.querySelector('.update-profile-modal');

    updateProfileModal.addEventListener('click', function(e) {

        if (e.target.classList.contains('update-profile-modal')) {
            updateProfileModal.style.display = 'none';
        }   else if (e.target.classList.contains('fa-times')) {
            updateProfileModal.style.display = 'none';
        }

        console.log(e.target);
    })


});