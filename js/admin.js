document.addEventListener('DOMContentLoaded', function() {
    // TOGGLE CLOSE OPEN 
    const nav = document.querySelector('nav');
    const toggleItem = document.querySelector('.admin-sidebar');

    nav.addEventListener('click', function(e) {

        if (e.target.classList.contains('fa-bars')) {
            e.target.className = 'fas fa-times';
            toggleItem.classList.add('block');

        }  else if (e.target.classList.contains('fa-times')) {
            e.target.className = 'fas fa-bars';
            toggleItem.classList.remove('block');
        }
        
    });

    // BLOGPOST DROPDOWN
    const blogDropdownTarget = document.querySelector('.blog-dropdown-target');
    const blogItem = document.querySelector('.blog-post-dropdown-item');

    blogDropdownTarget.addEventListener('click', function(e) {
        if (e.target.classList.contains('blog-dropdown-target')) {
            blogDropdownTarget.className = 'blog-dropdown-target-1';
            blogItem.className = 'blog-post-dropdown-item-1';
        }   else if (e.target.classList.contains('blog-dropdown-target-1')) {
            blogItem.className = 'blog-post-dropdown-item';
            blogDropdownTarget.className = 'blog-dropdown-target';
        }
    });

    // USER DROPDOWN
    const userDropDownTarget = document.querySelector('.user-dropdown-target');
    const userItem = document.querySelector('.user-dropdown-item');

    userDropDownTarget.addEventListener('click', function(e) {
        if (e.target.classList.contains('user-dropdown-target')) {
            userDropDownTarget.className = 'user-dropdown-target-1';
            userItem.className = 'user-dropdown-item-1';
        }   else if (e.target.classList.contains('user-dropdown-target-1')) {
            userDropDownTarget.className = 'user-dropdown-target';
            userItem.className = 'user-dropdown-item';
        }
    })

    const logOutToggle = document.querySelector('.logout-toggle');
    const logOutDropDown = document.querySelector('.logout-dropdown');

    logOutToggle.addEventListener('click', function(e) {
        if (e.target.classList.contains('logout-toggle')) {
            logOutToggle.className = 'logout-toggle-1';
            logOutDropDown.style.display = 'block';
        }   else if (e.target.classList.contains('logout-toggle-1')) {
            logOutToggle.className = 'logout-toggle';
            logOutDropDown.style.display = 'none';
        }
    });

    // CHECKBOX VIEW ALL BLOG POST

    const checkAllBox = document.querySelector('.select-all-checkbox');
    const allCheckBox = document.querySelectorAll('.checkbox');

    checkAllBox.addEventListener('change', function(e) {

        if (checkAllBox.checked) {
            allCheckBox.forEach(function(box) {
                box.checked = true;
            })
        }   else {
            allCheckBox.forEach(function(box) {
                box.checked = false;
            })
        }
    })



});

// WYSIWYG EDITOR FOR TEXTAREA
    // ClassicEditor
    //     .create( document.querySelector('#body') )
    //     .catch( error => {
    //         console.error( error );
    //     } );