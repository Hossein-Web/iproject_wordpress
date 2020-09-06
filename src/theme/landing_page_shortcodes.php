<?php

add_action('wp_enqueue_scripts', 'ivahid_landing_resources');
function ivahid_landing_resources()
{
    if ( is_page_template( 'page-ivahid.php' ) ){
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, true);
        wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
    }
}

//functions
function StrToArr( $str, $delimiter  ) {
    $arr = explode( $delimiter, $str );
    $result = [];
    foreach ( $arr as $item ) {
        $result[] = trim( $item );
    }
    return $result;
}

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
                        <img src="<?php echo get_template_directory_uri() . '/img/web_design_sec.png' ?>"
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
            <img class="background" src="<?php echo get_template_directory_uri() . '/img/your_position_back_2.png' ?>"
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
                            while (have_rows('your_position_steps')) {
                                the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="slide_info">
                                        <span><?php echo get_sub_field('step_title') ?></span>
                                        <div>
                                            <?php
                                            $i = get_row_index();
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
                            while (have_rows('your_position_steps')) {
                                the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="slide_content">
                                        <span>
                                            <?php
                                            $i = get_row_index();
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

add_shortcode('your_position', 'your_position_shortcode');

//services
function services_shortcode($atts)
{
    $attributes = shortcode_atts(array(
        'post_ids' => ''
    ), $atts);
    $post_ids = StrToArr( $attributes['post_ids'], ',' );
    $args = [
        'post__in' => $post_ids,
        'ignore_sticky_posts' => true
    ];
    $services_posts_query = new WP_Query($args);
    ob_start(); ?>
    <section class="services">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-24">
                    <div class="services__introduction">
                        <div class="title">
                            <h4><?php the_field('services_title_fa'); ?></h4>
                            <p><?php the_field('services_title_en'); ?></p>
                        </div><!-- .title -->
                        <p><?php the_field('services_description'); ?></p>
                    </div><!-- .services_introduction -->
                </div><!-- .col-xl-12 -->
                <div class="col-xl-12 col-lg-12 col-md-24">
                    <div class="services__list">
                        <?php
                        if ($services_posts_query->have_posts()) {
                            while ($services_posts_query->have_posts()) {
                                $services_posts_query->the_post(); ?>
                                <div class="services__list__item">
                                    <div class="item_title_wrapper">
                                        <div class="icon">
                                            <img src="<?php echo get_template_directory_uri() . '/img/wordpress-Logo.png' ?>"
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

add_shortcode('services', 'services_shortcode');

function design_effect_shortcode()
{
    ob_start();
    ?>
    <section class="design_effect">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-md-12 col-24">
                    <div class="design_effect__img">
                        <img src="<?php echo get_template_directory_uri() . '/img/design_effect.png' ?>"
                             alt="design_effect">
                    </div><!-- .img -->
                </div><!-- .col-xl-12 -->
                <div class="col-xl-12 col-md-12 col-24">
                    <div class="design_effect__wrapper">
                        <div class="content">
                            <div class="title title--red">
                                <h4><?php the_field('design_effect_title_fa'); ?></h4>
                                <p><?php the_field('design_effect_title_en'); ?></p>
                            </div><!-- .title -->
                            <p><?php the_field('design_effect_description'); ?></p>
                        </div><!-- .content -->
                    </div><!-- .design_effect__wrapper -->
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .design_effect -->
    <?php
    return ob_get_clean();
}

add_shortcode('design_effect', 'design_effect_shortcode');

function select_team_shortcode()
{
    ob_start();
    ?>
    <section class="select_team">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-24">
                    <div class="select_team__img">
                        <?php $select_team_img = get_field( 'select_team_img' ); ?>
                        <img src="<?php echo $select_team_img['url']; ?>" alt="<?php echo $select_team_img['alt']; ?>">
                        <div class="select_team__img__label">
                            <div class="icon">
                                <span class="icon-man"></span>
                            </div>
                            <div class="label">
                                <p>آی وحید</p>
                                <p>لذت تفاوت</p>
                            </div>
                        </div><!-- .select_team__img__label -->
                    </div><!-- .select_team__img -->
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-24 mr-auto">
                            <div class="select_team__content">
                                <div class="title">
                                    <h4><?php the_field('select_team_title_fa') ?></h4>
                                    <p><?php the_field('select_team_title_en'); ?></p>
                                </div><!-- .title -->
                                <p><?php the_field('select_team_description'); ?></p>
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

add_shortcode('select_team', 'select_team_shortcode');

function ivahid_difference_shortcode( $atts ){
    ob_start();
    ?>
    <section class="ivahid_difference">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-12">
                    <div class="ivahid_difference__img">
                        <?php $ivahid_difference_img = get_field( 'ivahid_difference_img' ); ?>
                        <img src="<?php echo $ivahid_difference_img['url']; ?>" alt="<?php echo $ivahid_difference_img['alt']; ?>">
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

function portal_shortcode( $atts ){
    ob_start();
    ?>
    <section class="portal">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-24 col-24">
                    <div class="portal__img">
                        <img src="<?php echo get_template_directory_uri() . '/img/portal.png' ?>" alt="portal">
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-24 mr-auto">
                            <div class="portal__content">
                                <div class="title title--white">
                                    <h4><?php the_field( 'portal_title' ); ?></h4>
                                </div><!-- .title -->
                                <p><?php the_field( 'portal_description' ); ?></p>
                                <div class="link">
                                    <?php
                                    $portal_link = get_field( 'portal_link' );
                                    $url = $portal_link['url'];
                                    $title = $portal_link['title'];
                                    ?>
                                    <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a>
                                </div>
                            </div><!-- .portal__content -->
                        </div><!-- .col-lg-12 -->
                    </div><!-- .row -->
                </div><!-- .col-md-24 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .portal -->
    <?php
    return ob_get_clean();
}
add_shortcode( 'portal', 'portal_shortcode' );

function services_card_shortcode(){
    ob_start();
    ?>
    <section class="services_card">
        <div class="container">
            <div class="title">
                <h4><?php the_field( 'services_card_title_fa' ); ?></h4>
                <p><?php the_field( 'services_card_title_en' ) ?></p>
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
                                    </div><!-- .img_wrapper -->
                                    <div class="text_wrapper">
                                        <h4><?php echo get_sub_field( 'services_card_title_fa' ); ?></h4>
                                        <span><?php echo get_sub_field( 'services_card_title_en' ); ?></span>
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

function podcast_shortcode(){
    ob_start();
    ?>
    <section class="podcast">
        <div class="container">
            <div class="row">
                <div class="col-md-24">
                    <div class="podcast__container">
                        <div class="podcast_img_wrapper">
                            <img class="img-fluid" src="http://127.0.0.1:3020/wp-content/uploads/2020/09/podcast.jpg" alt="podcast image">
                        </div><!-- .podcast_img_wrapper -->
                        <div class="podcast_wrapper" data-audio-link="<?php the_field( 'podcast_audio' ); ?>">
                            <div class="podcast_details">
                                <div class="podcast_title">
                                    <?php
                                    $podcast_title_link = get_field( 'podcast_title_link' );
                                    $podcast_topic_link = get_field( 'podcast_topic_link' );
                                    ?>
                                    <h4><a href="<?php echo esc_url( $podcast_title_link['url'] ); ?>"><?php echo esc_html( $podcast_title_link['title'] ); ?></a></h4>
                                    <span><a href="<?php echo esc_url( $podcast_topic_link['url'] ) ?>"><?php echo esc_html( $podcast_topic_link['title'] ) ?></a></span>
                                </div><!-- .podcast_title -->
                                <button class="podcast_button paused">
                                    <span class="icon-play"></span>
                                    <svg class="progress-ring" >
                                        <circle
                                                class="progress-ring__circle"
                                                stroke="#ff4342"
                                                stroke-width="1"
                                                fill="transparent"
                                                r="35"
                                                cx="35"
                                                cy="35"
                                        />
                                    </svg>
                                </button><!-- .podcast_button -->
                            </div><!-- .podcast_details -->
                            <div class="waveform_wrapper">
                                <span class="duration"></span>
                                <div id="waveform"></div><!-- #waveform -->
                                <span class="current_time">00.00</span>
                            </div><!-- .waveform_wrapper -->
                        </div><!-- .podcast_wrapper -->
                    </div><!-- .podcast__container -->
                </div><!-- .col-md-24 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .podcast -->
    <?php
    return ob_get_clean();
}
add_shortcode( 'podcast', 'podcast_shortcode' );

function customers_shortcode()
{
    ob_start();
    ?>
    <section class="customers">
        <div class="container">
            <div class="row">
                <div class="col-xl-24">
                    <div class="customers__wrapper">
                        <div class="swiper-container">
                            <div class="title">
                                <h4><?php the_field('customers_title_fa'); ?></h4>
                                <p><?php the_field('customers_title_en'); ?></p>
                            </div><!-- .title -->
                            <div class="swiper-pagination"></div>
                            <div class="swiper-wrapper">
                                <?php
                                if (have_rows('customers_logos')) {
                                    while (have_rows('customers_logos')) {
                                        the_row();
                                        $logo = get_sub_field('customer_logo');
                                        ?>
                                        <div class="swiper-slide">
                                            <div>
                                                <img src="<?php echo $logo['url']; ?>"
                                                     alt="<?php echo $logo['alt']; ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div><!-- .swiper-wrapper -->
                        </div><!-- .swiper-container -->
                    </div><!-- .customers__wrapper -->
                </div><!-- .col-xl-24 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .customers -->
    <?php
    return ob_get_clean();
}

add_shortcode('customers', 'customers_shortcode');

function portfolio_shortcode()
{
    ob_start();
    ?>
    <section class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <div class="portfolio__background">
                        <span></span>
                        <span></span>
                    </div>
                    <div class="portfolio__description">
                        <h4><?php the_field('portfolio_title'); ?></h4>
                        <p><?php the_field('portfolio_description'); ?></p>
                    </div><!-- .portfolio__description -->
                    <div class="portfolio__wrapper">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                if (have_rows('portfolio_items')) {
                                    while (have_rows('portfolio_items')) {
                                        the_row();
                                        $image = get_sub_field('item_image');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="portfolio__wrapper__item">
                                                <img src="<?php echo $image['url'] ?>"
                                                     alt="<?php echo $image['alt'] ?>">
                                                <h4><?php echo get_sub_field('item_title'); ?></h4>
                                                <p><?php echo get_sub_field('item_description') ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div><!-- .swiper-wrapper -->
                        </div><!-- .swiper-container -->
                        <div class="view_more">
                            <a href="#">مشاهده بیشتر</a>
                        </div><!-- .view_more -->
                    </div><!-- .portfolio__wrapper -->
                </div><!-- .col-24 -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </section><!-- .portfolio -->
    <?php
    return ob_get_clean();
}

add_shortcode('portfolio', 'portfolio_shortcode');

function order_shortcode()
{
    ob_start();
    ?>
    <section class="order">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-10 col-md-10">
                    <div class="title">
                        <h4><?php the_field('order_title_fa'); ?></h4>
                        <p><?php the_field('order_title_en'); ?></p>
                    </div><!-- .title -->
                </div><!-- .col-xl-10 -->
                <div class="col-xl-14 col-md-14">
                    <div class="order__content">
                        <ul>
                            <?php
                            if (have_rows('order_items')) {
                                while (have_rows('order_items')) {
                                    the_row();
                                    ?>
                                    <li>
                                        <span><?php echo get_row_index(); ?></span>
                                        <p><?php echo get_sub_field('item_description'); ?></p>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div><!-- .order__content -->
                </div><!-- .col-xl-14 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .order -->
    <?php
    return ob_get_clean();
}

add_shortcode('order', 'order_shortcode');

function videos_shortcode()
{
    ob_start();
    ?>
    <section class="videos">
        <div class="container">
            <div class="row">
                <div class="col-xl-24">
                    <div class="videos__wrapper">
                        <div class="swiper-container">
                            <div class="title">
                                <h4><?php the_field('videos_title_fa'); ?></h4>
                                <p><?php the_field('videos_title_en'); ?></p>
                            </div><!-- .title -->
                            <div class="swiper-pagination"></div>
                            <div class="swiper-wrapper">
                                <?php
                                if (have_rows('videos')) {
                                    while (have_rows('videos')) {
                                        the_row();
                                        $item_img = get_sub_field('item_img');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <a class="video_link" href="#"><span class="icon-play"></span></a>
                                                <img src="<?php echo $item_img['url'] ?>"
                                                     alt="<?php echo $item_img['alt'] ?>>">
                                                <p><?php echo get_sub_field('item_description') ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div><!-- .swiper-wrapper -->
                        </div><!-- .swiper-container -->
                    </div><!-- .videos__wrapper -->
                </div><!-- .col-xl-24 -->
            </div><!-- .row -->
        </div><!-- .container -->
        <img class="videos__background" src="<?php echo get_template_directory_uri() . '/img/dots-gray.png' ?>"
             alt="dot background">
    </section><!-- .videos -->
    <?php
    return ob_get_clean();
}

add_shortcode('videos', 'videos_shortcode');

function blog_shortcode( $atts ){
    ob_start();
    $attributes = shortcode_atts(
        array(
            'post_ids' => ''
        ),
        $atts
    );
    $post_ids = StrToArr( $attributes[ 'post_ids' ], ',' );
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
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </a>
                                        </div><!-- .post_img_wrapper -->
                                        <a class="post_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><!-- .post_title -->
                                        <!-- <h4></h4> -->
                                        <p class="post_excerpt">
                                            <?php the_excerpt(); ?>
                                        </p><!-- .post_excerpt -->
                                        <div class="read_more_wrapper">
                                            <a href="<?php the_permalink(); ?>">مشاهده بیشتر</a>
                                        </div><!-- .read_more_wrapper -->
                                    </div><!-- .post_wrapper -->
                                </div><!-- .swiper-slide -->
                                <?php
                            }
                            wp_reset_postdata();
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

