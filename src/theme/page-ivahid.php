<?php /* Template Name: ivahid */ ?>
<?php get_header(); ?>
<?php
if (have_posts()){
while (have_posts()){
the_post();
?>
<article class="web-design-page">
    <div class="web-design-page__content">
        <div class="container">
                 <?php
                    the_content();
                    ?>
        </div><!-- .container -->
    </div>
</article>
<div class="rattingpostpage" >
    امتیاز شما به این صفحه از نظر راهنمایی ؟
    <?php if(function_exists('the_ratings')) { the_ratings(); schema();} ?>
</div>
    <?php
      }
    }
else{
    echo "چیزی پیدا نشد";
}
	wp_reset_query();
?>
<?php comments_template(); ?>
<?php get_footer(); ?>
