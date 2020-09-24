<?php /* Template Name: ivahid-copy */ ?>
<?php get_header(); ?>
<article class="web-design-page">
    <header>
        <div class="container">
            <h1 class="web-design-page__title"><?php the_title(); ?></h1>
        </div><!-- .container -->
    </header>
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
