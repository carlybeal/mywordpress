
/* Toggle dropdown menu visability when clicked */
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.dropdown-btn');

    dropdownButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const targetId = this.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);

            // Hide all dropdowns
            document.querySelectorAll('.dropdown-content').forEach(content => {
                if (content !== targetContent) {
                    content.style.display = 'none';
                }
            });

            // Toggle the clicked dropdown
            if (targetContent.style.display === 'block') {
                targetContent.style.display = 'none';
            } else {
                targetContent.style.display = 'block';
            }
        });
    });

    // Hide dropdowns if clicking outside of them
    document.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.style.display = 'none';
        });
    });
});

/* Executes search query */
document.addEventListener('DOMContentLoaded', function () {
    const searchIcon = document.querySelector('.search-bar .search-icon');
    const searchForm = document.getElementById('searchForm');
    const searchInput = searchForm.querySelector('input[name="s"]');

    // Submit form when search icon is clicked
    if (searchIcon && searchForm) {
        searchIcon.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default button behavior
            searchForm.submit(); // Submit the form
        });
    }

    // Submit form when "Enter" key is pressed in the search input
    if (searchInput) {
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent the default form submit behavior
                searchForm.submit(); // Submit the form
            }
        });
    }
});

/* Handles opening/closing of sidebar in header */
document.addEventListener('DOMContentLoaded', function () {
    const accountIcon = document.getElementById('account-icon');
    const sidebarMenu = document.getElementById('sidebarMenu');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    // Open sidebar and overlay
    accountIcon.addEventListener('click', function () {
        sidebarMenu.classList.add('open');
        overlay.classList.add('active');
    });

    // Close sidebar and overlay
    closeSidebar.addEventListener('click', function () {
        sidebarMenu.classList.remove('open');
        overlay.classList.remove('active');
    });

    // Close sidebar and overlay when clicking outside
    document.addEventListener('click', function (event) {
        if (!sidebarMenu.contains(event.target) && !accountIcon.contains(event.target)) {
            sidebarMenu.classList.remove('open');
            overlay.classList.remove('active');
        }
    });
});




// Filter 
document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll('#product-filter-form .filter-checkbox');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            document.getElementById('product-filter-form').submit();
        });
    });
});
