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

function services_card_shortcode(){
    ob_start();
    ?>
    <section class="services_card">
        <div class="container">
            <div class="title">
                <h4><?php the_title( 'services_card_title_fa' ); ?></h4>
                <p><?php the_title( 'services_card_title_en' ) ?></p>
            </div><!-- .title -->
            <div class="services_card__wrapper">
                <div class="row">
                    <?php
                    if ( have_rows( 'services_cards' ) ){
                        while ( have_rows( 'services_cards' ) ){
                            the_row();
                            ?>
                            <div class="col-md-24 col-lg-8">
                                <div class="item">
                                    <div class="img_wrapper">
                                        <?php echo get_sub_field('services_card_svg'); ?>
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 62 62">-->
<!--                                            <defs>-->
<!--                                                <clipPath id="it79a">-->
<!--                                                    <path d="M16.825 4.046h2.05v2.049h-2.05zm4.1 0h8.198v2.049h-8.199zm19.47 34.843h2.05v5.124a7.183 7.183 0 0 1-7.173 7.174H16.588l1.262 2.097a7.18 7.18 0 0 1 1.025 3.697v4.444h-2.05v-4.444c0-.93-.254-1.844-.732-2.642l-2.196-3.648a1.024 1.024 0 0 1-.009-1.042l4.612-7.987a2.048 2.048 0 0 0-3.55-2.05L10.338 47.6a1.023 1.023 0 1 1-1.825-.092 7.134 7.134 0 0 1-.911-3.495V30.052l-4.275 9.277a9.075 9.075 0 0 0-.85 3.865v18.24H.429v-18.24a11.135 11.135 0 0 1 1.038-4.727l4.652-10.092a3.077 3.077 0 0 1 1.484-1.476V7.119a7.182 7.182 0 0 1 7.174-7.172h20.496a7.201 7.201 0 0 1 6.211 3.586L39.71 4.558a5.144 5.144 0 0 0-4.437-2.562H14.776A5.13 5.13 0 0 0 9.652 7.12v36.893c0 .205.013.41.038.613l3.485-6.038a4.088 4.088 0 0 1 7.306 3.639 3.07 3.07 0 0 1 2.493-1.288h4.1a3.074 3.074 0 1 1 0 6.148h-4.1a3.074 3.074 0 0 1-3.074-3.074c.004-.332.062-.664.174-.977l-3.524 6.1h18.722a5.13 5.13 0 0 0 5.124-5.123zm-17.421 4.1a1.025 1.025 0 0 0 0 2.049h4.1a1.025 1.025 0 0 0 0-2.05zM58.955 12.06A16.396 16.396 0 0 1 45.53 37.865a17.127 17.127 0 0 1-2.86-.246 16.328 16.328 0 0 1-8.075-3.926l-6.692 1.25c-.397.073-.8-.091-1.035-.42a1.026 1.026 0 0 1-.04-1.106l3.463-5.873c-3.096-7.734.1-16.56 7.43-20.52 7.33-3.96 16.463-1.794 21.234 5.036zm.697 11.897c1.375-7.804-3.837-15.246-11.642-16.622-7.805-1.375-15.247 3.837-16.622 11.643a14.223 14.223 0 0 0 .993 8.239c.125.304.102.648-.06.933l-2.583 4.365 4.99-.933c.061-.008.123-.012.185-.01.262 0 .515.098.707.277a14.349 14.349 0 0 0 24.032-7.892zm-6.959-8.638c.566 0 1.025.458 1.025 1.024v12.298a3.083 3.083 0 0 1-3.074 3.074H40.396a3.083 3.083 0 0 1-3.075-3.074V16.343c0-.566.46-1.024 1.025-1.024h3.075v-1.025a4.099 4.099 0 0 1 8.198 0v1.025zm-9.223 0h4.1v-1.025a2.05 2.05 0 1 0-4.1 0zm8.199 12.297H39.37v1.025c0 .566.46 1.025 1.025 1.025h10.248c.566 0 1.025-.459 1.025-1.025zm0-10.248h-2.05v2.05h-2.05v-2.05H43.47v2.05h-2.05v-2.05h-2.049v8.199h12.298zm-28.995-2.35l-1.578 1.578a5.14 5.14 0 0 1-7.92 6.471 5.14 5.14 0 0 1 6.47-7.92l1.579-1.578zm-2.774 4.4a3.026 3.026 0 0 0-.308-1.318l-3.067 3.066-1.45-1.449 3.067-3.066c-.41-.201-.86-.306-1.317-.308a3.074 3.074 0 1 0 3.075 3.075zm4.099-3.075h4.1v2.05h-4.1zm0 4.1h4.1v2.049h-4.1z"/>-->
<!--                                                </clipPath>-->
<!--                                            </defs>-->
<!--                                            <g>-->
<!--                                                <g>-->
<!--                                                    <path  class="wrapper_part" fill="#7a7a7a" d="M16.825 4.046h2.05v2.049h-2.05zm4.1 0h8.198v2.049h-8.199zm19.47 34.843h2.05v5.124a7.183 7.183 0 0 1-7.173 7.174H16.588l1.262 2.097a7.18 7.18 0 0 1 1.025 3.697v4.444h-2.05v-4.444c0-.93-.254-1.844-.732-2.642l-2.196-3.648a1.024 1.024 0 0 1-.009-1.042l4.612-7.987a2.048 2.048 0 0 0-3.55-2.05L10.338 47.6a1.023 1.023 0 1 1-1.825-.092 7.134 7.134 0 0 1-.911-3.495V30.052l-4.275 9.277a9.075 9.075 0 0 0-.85 3.865v18.24H.429v-18.24a11.135 11.135 0 0 1 1.038-4.727l4.652-10.092a3.077 3.077 0 0 1 1.484-1.476V7.119a7.182 7.182 0 0 1 7.174-7.172h20.496a7.201 7.201 0 0 1 6.211 3.586L39.71 4.558a5.144 5.144 0 0 0-4.437-2.562H14.776A5.13 5.13 0 0 0 9.652 7.12v36.893c0 .205.013.41.038.613l3.485-6.038a4.088 4.088 0 0 1 7.306 3.639 3.07 3.07 0 0 1 2.493-1.288h4.1a3.074 3.074 0 1 1 0 6.148h-4.1a3.074 3.074 0 0 1-3.074-3.074c.004-.332.062-.664.174-.977l-3.524 6.1h18.722a5.13 5.13 0 0 0 5.124-5.123zm-17.421 4.1a1.025 1.025 0 0 0 0 2.049h4.1a1.025 1.025 0 0 0 0-2.05zM58.955 12.06A16.396 16.396 0 0 1 45.53 37.865a17.127 17.127 0 0 1-2.86-.246 16.328 16.328 0 0 1-8.075-3.926l-6.692 1.25c-.397.073-.8-.091-1.035-.42a1.026 1.026 0 0 1-.04-1.106l3.463-5.873c-3.096-7.734.1-16.56 7.43-20.52 7.33-3.96 16.463-1.794 21.234 5.036zm.697 11.897c1.375-7.804-3.837-15.246-11.642-16.622-7.805-1.375-15.247 3.837-16.622 11.643a14.223 14.223 0 0 0 .993 8.239c.125.304.102.648-.06.933l-2.583 4.365 4.99-.933c.061-.008.123-.012.185-.01.262 0 .515.098.707.277a14.349 14.349 0 0 0 24.032-7.892zm-6.959-8.638c.566 0 1.025.458 1.025 1.024v12.298a3.083 3.083 0 0 1-3.074 3.074H40.396a3.083 3.083 0 0 1-3.075-3.074V16.343c0-.566.46-1.024 1.025-1.024h3.075v-1.025a4.099 4.099 0 0 1 8.198 0v1.025zm-9.223 0h4.1v-1.025a2.05 2.05 0 1 0-4.1 0zm8.199 12.297H39.37v1.025c0 .566.46 1.025 1.025 1.025h10.248c.566 0 1.025-.459 1.025-1.025zm0-10.248h-2.05v2.05h-2.05v-2.05H43.47v2.05h-2.05v-2.05h-2.049v8.199h12.298zm-28.995-2.35l-1.578 1.578a5.14 5.14 0 0 1-7.92 6.471 5.14 5.14 0 0 1 6.47-7.92l1.579-1.578zm-2.774 4.4a3.026 3.026 0 0 0-.308-1.318l-3.067 3.066-1.45-1.449 3.067-3.066c-.41-.201-.86-.306-1.317-.308a3.074 3.074 0 1 0 3.075 3.075zm4.099-3.075h4.1v2.05h-4.1zm0 4.1h4.1v2.049h-4.1z"/>-->
<!--                                                </g>-->
<!--                                                <g clip-path="url(#it79a)">-->
<!--                                                    <path class="inner_part" fill="#ff4342" d="M45.136 9.494c6.668 0 12.073 5.406 12.073 12.074s-5.405 12.074-12.073 12.074c-6.669 0-12.074-5.406-12.074-12.074S38.467 9.494 45.136 9.494z"/>-->
<!--                                                </g>-->
<!--                                            </g>-->
<!--                                        </svg>-->
                                    </div><!-- .img_wrapper -->
                                    <div class="text_wrapper">
                                        <h4><?php echo get_sub_field( 'services_card_title_fa' ); ?>></h4>
                                        <span><?php echo get_sub_field( 'services_card_title_en' ); ?>></span>
                                    </div><!-- .text_wrapper -->
                                </div><!-- .item -->
                            </div><!-- .col-lg-8 -->
                            <?php
                        }
                    }
                    ?>
                </div><!-- .row -->
            </div><!-- .services_card__wrapper -->
        </div><!-- .container -->
    </section><!-- .services_card -->
<?php
    return ob_get_clean();
}
add_shortcode( 'services_card', 'services_card_shortcode' );