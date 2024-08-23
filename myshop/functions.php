<?php
if (! defined('ABSPATH')) { // to prevent any PHP from being executed if the file is accessed directly outside a WordPress context */
    exit;
}

if (! function_exists('myshop_theme_setup')) {
    function myshop_theme_setup()
    {
        add_theme_support('woocommerce');
        add_theme_support('title-tag');     // Adds dynamic title tag support
        add_theme_support('post-thumbnails');
        add_theme_support('custom-header', array(
            'flex-width' => true,
            'width' => 1762,
            'flex-height' => true,
            'height' => 761,
        ));
        add_theme_support('automatic-feed-links');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height'        => 150,
            'width'         => 200,
            'flex-height'   => true,
            'flex-width'    => true,
            'header-text'   => array('site-title', 'site-description'),
        ));
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
    }
}
add_action('after_setup_theme', 'myshop_theme_setup');

if (! function_exists('myshop_register_styles')) {
    function myshop_register_styles()
    { // Adds custom styles to a theme/plugin without directly modifying the theme's files

        $version = wp_get_theme()->get('Version');
        wp_enqueue_style('myshop-style', get_template_directory_uri() . "/style.css", array('myshop-bootstrap'), $version, 'all');
        wp_enqueue_style('myshop-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css", array(), '5.3.2', 'all');
        wp_enqueue_style('myshop-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css", array(), '6.6.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'myshop_register_styles');


if (! function_exists('myshop_register_scripts')) {
    function myshop_register_scripts()
    {  //.js

        $version = wp_get_theme()->get('Version');
        wp_enqueue_script('myshop-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
        wp_enqueue_script('myshop-popper.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js', array(), '2.11.8', true);
        wp_enqueue_script('myshop-bootstrap.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js', array(), '5.3.2', true);
        wp_enqueue_script('myshop-mainjs', get_template_directory_uri() . "/assets/js/main.js", array(), $version, false);
    }
}
add_action('wp_enqueue_scripts', 'myshop_register_scripts');


// remove logged in header bar
add_filter('show_admin_bar', '__return_false');
?>


<?php
// Function to display the filter form
function carlys_shop_product_filter()
{
    // Get all product categories
    $categories = get_terms('product_cat');
?>
    <form id="product-filter-form" method="get">
        <div class="filter-group">
            <h3>Filter by Category</h3>
            <?php foreach ($categories as $category): ?>
                <label>
                    <input type="checkbox" name="product_cat[]" value="<?php echo esc_attr($category->slug); ?>" <?php if (isset($_GET['product_cat']) && in_array($category->slug, (array)$_GET['product_cat'])) echo 'checked'; ?> class="filter-checkbox" />
                    <?php echo esc_html($category->name); ?>
                </label>
            <?php endforeach; ?>
        </div>
    </form>
<?php
}



// Function to display the filter and products together
function carlys_shop_product_filter_and_products()
{
?>
    <div class="shop-container">
        <aside class="shop-filter">
            <?php carlys_shop_product_filter(); ?>
        </aside>
        <div class="shop-products">
            <?php woocommerce_product_loop_start(); ?>

            <?php if (wc_get_loop_prop('total')) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>
                    <?php wc_get_template_part('content', 'product'); ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php woocommerce_product_loop_end(); ?>
        </div>
    </div>
<?php
}

// Hook the filter and products into the shop page
remove_action('woocommerce_before_shop_loop', 'carlys_shop_product_filter', 15);
add_action('woocommerce_before_main_content', 'carlys_shop_product_filter_and_products', 15);

// Modify the WooCommerce query to filter products
function carlys_shop_filter_products_query($query)
{
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $tax_query = array();

        // Check if any categories are selected
        if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $_GET['product_cat'],
            );
        }

        // Apply the tax query if necessary
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'carlys_shop_filter_products_query');

?>

































































<?php
function remove_woocommerce_shop_from_homepage($query)
{
    if (is_front_page() && is_main_query() && !is_admin()) {
        $query->set('post_type', 'page');
        $query->set('page_id', get_option('page_on_front'));

        // Enqueue custom JavaScript to hide WooCommerce elements
        add_action('wp_enqueue_scripts', 'hide_woocommerce_elements_on_homepage');
    }
}
add_action('pre_get_posts', 'remove_woocommerce_shop_from_homepage');



// Function to enqueue JavaScript
function hide_woocommerce_elements_on_homepage()
{
    if (is_front_page()) {
?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const woocommerceElements = document.querySelectorAll('.woocommerce-products-header, .woocommerce, .woocommerce-result-count, .woocommerce-ordering');
                woocommerceElements.forEach(function(element) {
                    element.style.display = 'none';
                });
            });
        </script>
<?php
    }
}
