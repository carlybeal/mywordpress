<?php get_header(); ?>

<?php
echo "Single Page";
?>

<div class="header-padding"></div>
<div class="container">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); // Makes WP query the DB and fetch out a single post
            the_content(); // Function that grabs the content
        }
    }
    ?>
</div>

<?php get_footer(); ?>