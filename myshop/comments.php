<?php get_header(); ?>
<div class="header-padding"></div>
<?php
echo "Comments Page";
?>
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