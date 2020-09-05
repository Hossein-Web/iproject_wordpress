<?php
function wordpressify_resources()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
    wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
}

add_action('wp_enqueue_scripts', 'wordpressify_resources');

// Customize excerpt word count length
function custom_excerpt_length()
{
    return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function wordpressify_setup()
{
    // Handle Titles
    add_theme_support('title-tag');

    // Add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 720, 720, true);
    add_image_size('square-thumbnail', 80, 80, true);
    add_image_size('banner-image', 1024, 1024, true);
}

add_action('after_setup_theme', 'wordpressify_setup');

show_admin_bar(false);

// Checks if there are any posts in the results
function is_search_has_results()
{
    return 0 != $GLOBALS['wp_query']->found_posts;
}

// Add Widget Areas
function wordpressify_widgets()
{
    register_sidebar(
        array(
            'name' => 'Sidebar',
            'id' => 'sidebar1',
            'before_widget' => '<div class="widget-item">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'wordpressify_widgets');

// shortcodes
//web design sec
function web_design_sec_shortcode($atts)
{
    ob_start(); ?>
    <section class="web_design_sec">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="web_design_sec__text">
                        <div class="title title--red">
                            <h4><?php the_field('web_design_sec_title_fa'); ?></h4>
                            <p><?php the_field('web_design_sec_title_en'); ?></p>
                        </div><!-- .title -->
                        <p><?php the_field('web_design_sec_description'); ?></p>
                    </div><!-- .web_design_sec_text__content -->
                </div><!-- .col-xl-10 -->
                <div class="col-xl-12">
                    <div class="web_design_sec__img_wrapper">
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/web_design_sec.png"
                             alt="section image">
                    </div><!-- .web_design_sec__img_wrapper -->
                </div><!-- .col-xl-12 -->
            </div><!-- .row -->
        </div><!-- .container-->
        <a class="web_design_sec__go_bottom" href="#">
            <span class="icon-arrow-down"></span>
        </a><!-- .web_design_sec__go_bottom -->
    </section><!-- .web_design_sec -->
    <?php
    return ob_get_clean();
}

add_shortcode('web_design_sec', 'web_design_sec_shortcode');

function design_effect_shortcode(){
    ob_start();
    ?>
    <section class="design_effect">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-md-12 col-24">
                    <div class="design_effect__img">
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/design_effect.png" alt="design_effect">
                    </div><!-- .img -->
                </div><!-- .col-xl-12 -->
                <div class="col-xl-12 col-md-12 col-24">
                    <div class="design_effect__wrapper">
                        <div class="content">
                            <div class="title title--red">
                                <h4><?php the_field( 'web_design_sec_title_fa' ); ?></h4>
                                <p><?php the_field( 'web_design_sec_title_en' ); ?></p>
                            </div><!-- .title -->
                            <p><?php the_field( 'web_design_sec_description' ); ?></p>
                        </div><!-- .content -->
                    </div><!-- .design_effect__wrapper -->
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .design_effect -->
    <?php
    return ob_get_clean();
}
add_shortcode( 'design_effect', 'design_effect_shortcode' );

function blog_shortcode( $atts ){
    ob_start();
    $attributes = shortcode_atts(
            array(
                    'post_ids' => ''
            ),
        $atts
    );
    $posts_ids_str = $attributes[ 'post_ids' ];
    $post_ids_array = explode( ',', $posts_ids_str );

    $post_ids = [];
    foreach ( $post_ids_array as $post_id ){
        $post_ids[] = trim( $post_id );
    }

    $args = [
        'post__in'            => $post_ids,
        'ignore_sticky_posts' => true
    ];
    $blog_posts = new WP_Query( $args );
?>
    <section class="blog">
        <div class="container">
            <div class="blog__wrapper">
                <div class="swiper-container">
                    <div class="title">
                        <h4><?php the_field( 'blog_title_fa' ); ?></h4>
                        <p><?php the_field( 'blog_title_en' ); ?></p>
                    </div><!-- .title -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-wrapper">
                        <?php
                       if ( $blog_posts->have_posts() ){
                           while ( $blog_posts->have_posts() ){
                               $blog_posts->the_post();
                               ?>
                               <div class="swiper-slide">
                                   <div class="post_wrapper">
                                       <div class="post_img_wrapper">
                                           <a href="<?php the_permalink(); ?>>">
                                               <!--<img class="img-fluid" src="./assets/img/page_speed.jpg" alt="post image">--><!-- .img-fluid -->
                                               <?php echo get_the_post_thumbnail(); ?>
                                           </a>
                                       </div><!-- .post_img_wrapper -->
                                       <a class="post_title" href="<?php the_permalink(); ?>>"><?php the_title(); ?></a><!-- .post_title -->
                                       <!-- <h4></h4> -->
                                       <p class="post_excerpt">
                                           <?php the_excerpt(); ?>
                                       </p><!-- .post_excerpt -->
                                       <div class="read_more_wrapper">
                                           <a href="<?php the_permalink(); ?>>">مشاهده بیشتر</a>
                                       </div><!-- .read_more_wrapper -->
                                   </div><!-- .post_wrapper -->
                               </div><!-- .swiper-slide -->
                               <?php
                           }
                       }
                        ?>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .swiper-container -->
            </div><!-- .blog__wrapper -->
        </div><!-- .container -->
    </section><!-- .blog -->
<?php
    return ob_get_clean();
}
add_shortcode( 'blog', 'blog_shortcode' );
