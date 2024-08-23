<?php
/* Template Name: Shop Page
*/
get_header(); ?>
<div class="header-padding"></div>
<?php echo "testing"; ?>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post(); // Makes WP query the DB and fetch out a single post
                        the_content(); // Function that grabs the content
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>