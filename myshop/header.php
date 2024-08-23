<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <nav class="navbar text-md">
        <div class="logo">
            <?php // Inserts the logo into the header
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $home_url = get_home_url();
            if (has_custom_logo()) {
                echo '<a href="' . esc_url($home_url) . '">
                    <img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">
                    </a>';
            }
            ?>
        </div>
        <div class="shop-name">
            <a href="<?php echo esc_url($home_url); ?>"><?php bloginfo('name'); ?></a>
        </div>
        <div class="directory">
            <div class="dropdown">
                <a href="<?php echo esc_url(home_url('/store')); ?>">Store</a>
                <button class="dropdown-btn" data-target="clothing-dropdown-content">Clothing</button>
                <div id="clothing-dropdown-content" class="dropdown-content">
                    <a href="<?php echo esc_url(home_url('/store')); ?>">View All</a>

                    <div class="dropdown-submenu">
                        <a href="#">Men's</a>
                        <div class="dropdown-subcontent">
                            <a href="#">T-Shirts</a>
                            <a href="#">Jeans</a>
                        </div>
                    </div>
                    <div class="dropdown-submenu">
                        <a href="#">Women's</a>
                        <div class="dropdown-subcontent">
                            <a href="#">T-Shirts</a>
                            <a href="#">Jeans</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="dropdown">
                <button class="dropdown-btn" data-target="shoes-dropdown-content">Shoes & Accessories</button>
                <div id="shoes-dropdown-content" class="dropdown-content">
                    <a href="<?php echo esc_url(home_url('/store')); ?>">View All</a>

                    <div class="dropdown-submenu">
                        <a href="#">Men's</a>
                        <div class="dropdown-subcontent">
                            <a href="#">Hats</a>
                            <a href="#">Shoes</a>
                            <a href="#">Sunglasses</a>
                        </div>
                    </div>
                    <div class="dropdown-submenu">
                        <a href="#">Women's</a>
                        <div class="dropdown-subcontent">
                            <a href="#">Hats</a>
                            <a href="#">Shoes</a>
                            <a href="#">Sunglasses</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <form class="search-bar" id="searchForm" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <div class="search-container">
                <input type="text" name="s" placeholder="Search Carly's Shop" value="<?php echo get_search_query(); ?>" autocomplete="off">
                <i class="search-icon fas fa-search"></i>
            </div>
        </form>
        <div class="main-menu">
            <div class="account">
                <button class="account-btn" id="account-icon">
                    <i class="fas fa-user"></i>
                </button>
            </div>



            <div class="shopping-cart">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </nav>


    <!-- Main Sidebar Menu -->
    <div class="sidebar-menu" id="sidebarMenu">
        <div class="sidebar-header">
            <button class="close-btn" id="closeSidebar"><i class="fa-solid fa-x"></i></button>
        </div>
        <h2 class="sidebar-title">Account</h2>
        <div class="sidebar-content-buttons">
            <button class="sidebar-btn" id="signInButton">Sign In</button>
            <button class="sidebar-btn" id="createAccountButton">Create Account</button>
        </div>
        <div class="separator"></div>
        <div class="sidebar-content">

            <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="account-info-link">Account Settings</a>
        </div>
    </div>
    <div class="overlay" id="overlay"></div>
</body>

</html>