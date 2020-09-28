<?php /* Template Name: ivahid */ ?>
<?php get_header(); ?>
<article class="web-design-page">
    <div class="web-design-page__content">
        <div class="container">
            <?php
            if ( have_posts() ){
                while ( have_posts() ){
                    the_post();
                    the_content();
                }
            }
            ?>
        </div><!-- .container -->
    </div>
</article>
<?php get_footer(); ?>
