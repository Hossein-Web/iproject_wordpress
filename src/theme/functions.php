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

//services
function services_shortcode( $atts ) {
    $attributes = shortcode_atts( array(
            'post_ids' => ''
    ), $atts );
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
    $services_posts_query = new WP_Query( $args );
    ob_start(); ?>
    <section class="services">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-24">
                    <div class="services__introduction">
                        <div class="title">
                            <h4><?php the_field( 'services_title_fa' ); ?></h4>
                            <p><?php the_field( 'services_title_en' ); ?></p>
                        </div><!-- .title -->
                        <p><?php the_field( 'services_description' ); ?></p>
                    </div><!-- .services_introduction -->
                </div><!-- .col-xl-12 -->
                <div class="col-xl-12 col-lg-12 col-md-24">
                    <div class="services__list">
                        <?php
                        if ( $services_posts_query->have_posts() ) {
                            while ($services_posts_query->have_posts()) {
                                $services_posts_query->the_post(); ?>
                                <div class="services__list__item">
                                    <div class="item_title_wrapper">
                                        <div class="icon">
                                            <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/wordpress-Logo.png"
                                                 alt="wordpress logo">
                                        </div>
                                        <div class="title">
                                            <p><?php the_title() ?></p>
                                            <?php
                                            $post_cats_id = wp_get_post_categories(get_the_ID());
                                            for ($i = 0; $i < count($post_cats_id); $i++) {
                                                ?>
                                                <a href="<?php echo get_category_link($post_cats_id[$i]); ?>"><?php echo get_the_category_by_ID($post_cats_id[$i]); ?></a>
                                                <?php
                                                if ((count($post_cats_id) > 1) && ($i < count($post_cats_id) - 1)) {
                                                    ?>
                                                    <span> ,</span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </p>
                                        </div>
                                    </div><!-- .item_title_wrapper -->
                                    <div class="content">
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="read_more">اطلاعات بیشتر</a>
                                    </div>
                                </div><!-- .services__list__item -->
                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div><!-- .services__list -->
                </div><!-- .col-xl-12-->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .services -->
<?php return ob_get_clean();
}
add_shortcode( 'services', 'services_shortcode' );

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
                                <h4><?php the_field( 'design_effect_title_fa' ); ?></h4>
                                <p><?php the_field( 'design_effect_title_en' ); ?></p>
                            </div><!-- .title -->
                            <p><?php the_field( 'design_effect_description' ); ?></p>
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

function select_team_shortcode(){
    ob_start();
    ?>
    <section class="select_team">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-24">
                    <div class="select_team__img">
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/select_team2.jpg" alt="design_effect">
                        <div class="select_team__img__lable">
                            <div class="icon">
                                <span class="icon-man"></span>
                            </div>
                            <div class="lable">
                                <p>آی وحید</p>
                                <p>لذت تفاوت</p>
                            </div>
                        </div><!-- .select_team__img__lable -->
                    </div><!-- .select_team__img -->
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-24 mr-auto">
                            <div class="select_team__content">
                                <div class="title">
                                    <h4><?php the_field( 'select_team_title_fa') ?></h4>
                                    <p><?php the_field( 'select_team_title_en'); ?></p>
                                </div><!-- .title -->
                                <p><?php the_field( 'select_team_description'); ?></p>
                            </div><!-- .select_team__content -->
                        </div><!-- .col-lg-12 -->
                    </div><!-- .row -->
                </div><!-- .col-xl-24 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .select_team -->
<?php
    return ob_get_clean();
}
add_shortcode( 'select_team', 'select_team_shortcode' );

function ivahid_difference_shortcode( $atts ){
    ob_start();
    ?>
    <section class="ivahid_difference">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-12">
                    <div class="ivahid_difference__img">
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/ivahid.png" alt="ivahid">
                    </div><!-- .ivahid_difference__img -->
                </div><!-- .col-xl-9 -->
                <div class="col-xl-15 col-lg-15 col-md-12">
                    <div class="ivahid_difference__content">
                        <div class="title">
                            <h4><?php the_field( 'ivahid_difference_title_fa' ); ?></h4>
                            <p><?php the_field( 'ivahid_difference_title_en' ); ?></p>
                        </div><!-- .title -->
                        <p><?php the_field( 'ivahid_difference_description' ); ?></p>
                    </div><!-- .ivahid_difference__content -->
                </div><!-- .col-xl-15 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .ivahid_difference -->
<?php
    return ob_get_clean();
}
add_shortcode( 'ivahid_difference', 'ivahid_difference_shortcode' );