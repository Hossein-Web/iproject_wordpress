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

// your position
function your_position_shortcode()
{
    ob_start(); ?>
    <section class="your_position">
        <div class="outer_text_wrapper">
            <div class="container">
                <div class="text">
                    <div class="title">
                        <h4><?php the_field('your_position_title_fa'); ?></h4>
                        <p><?php the_field('your_position_title_en'); ?></p>
                    </div><!-- .title -->
                    <p><?php the_field('your_position_description'); ?></p>
                </div><!-- .text -->
            </div><!-- .container -->
        </div><!-- .outer_text_wrapper -->
        <div class="your_position__content_wrapper">
            <img class="background" src="http://127.0.0.1:3020/wp-content/uploads/2020/09/your_position_back_2.png"
                 alt="your position background">
            <div class="your_position__container">
                <div class="col-lg-21">
                    <div class="inner_text_wrapper">
                        <div class="text">
                            <div class="title">
                                <h4><?php the_field('your_position_title_fa'); ?></h4>
                                <p><?php the_field('your_position_title_en'); ?></p>
                            </div><!-- .title -->
                            <p><?php the_field('your_position_description'); ?></p>
                        </div><!-- .text -->
                    </div><!-- .inner_text_wrapper -->
                </div><!-- .col-lg-21 -->
                <div class="swiper-container categories_title_list">
                    <div class="swiper-wrapper">
                        <?php
                        if (have_rows('your_position_steps')) {
                            $i = 1;
                            while (have_rows('your_position_steps')) {
                                the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="slide_info">
                                        <span><?php echo get_sub_field('step_title') ?></span>
                                        <div>
                                            <?php
                                            if ($i < 10)
                                                echo '0' . $i;
                                            else
                                                echo $i;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                wp_reset_postdata();
                            }
                        }
                        ?>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .categories_title_list -->
                <div class="swiper-container categories_description_list">
                    <div class="swiper-wrapper">
                        <?php
                        if (have_rows('your_position_steps')) {
                            $i = 1;
                            while (have_rows('your_position_steps')) {
                                the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="slide_content">
                                        <span>
                                            <?php
                                            if ($i < 10)
                                                echo '0' . $i;
                                            else
                                                echo $i;
                                            ?>
                                        </span>
                                        <h4><?php echo get_sub_field('step_title') ?></h4>
                                        <p><?php echo get_sub_field('step_description') ?></p>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                wp_reset_postdata();
                            }
                        }
                        ?>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .categories_description_list -->
            </div><!-- .your_position_wrapper -->
        </div><!-- .image_container -->
    </section><!-- .your_position -->
    <?php
    return ob_get_clean();
}

add_shortcode( 'your_position' , 'your_position_shortcode' );














