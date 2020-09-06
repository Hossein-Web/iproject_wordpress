<?php

add_action('wp_enqueue_scripts', 'ivahid_landing_resources');
function ivahid_landing_resources()
{
    if ( is_page_template( 'page-ivahid.php' ) ){
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
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
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/design_effect.png"
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
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/select_team2.jpg"
                             alt="design_effect">
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

function ivahid_difference_shortcode($atts)
{
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
                            <h4><?php the_field('ivahid_difference_title_fa'); ?></h4>
                            <p><?php the_field('ivahid_difference_title_en'); ?></p>
                        </div><!-- .title -->
                        <p><?php the_field('ivahid_difference_description'); ?></p>
                    </div><!-- .ivahid_difference__content -->
                </div><!-- .col-xl-15 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .ivahid_difference -->
    <?php
    return ob_get_clean();
}

add_shortcode('ivahid_difference', 'ivahid_difference_shortcode');

function portal_shortcode($atts)
{
    ob_start();
    ?>
    <section class="portal">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-24 col-24">
                    <div class="portal__img">
                        <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/portal.png" alt="portal">
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-24 mr-auto">
                            <div class="portal__content">
                                <div class="title title--white">
                                    <h4><?php the_field('portal_title'); ?></h4>
                                </div><!-- .title -->
                                <p><?php the_field('portal_description'); ?></p>
                                <div class="link">
                                    <a href="#">پرتال مشتریان</a>
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

add_shortcode('portal', 'portal_shortcode');

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

//function services_card_shortcode()
//{
//    ob_start();
//    ?>
<!--    <section class="services_card">-->
<!--        <div class="container">-->
<!--            <div class="title">-->
<!--                <h4>--><?php //the_field('services_card_title_fa'); ?><!--</h4>-->
<!--                <p>--><?php //the_field('services_card_title_en') ?><!--</p>-->
<!--            </div><!-- .title -->-->
<!--            <div class="services_card__wrapper">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-24 col-lg-8">-->
<!--                        <div class="item">-->
<!--                            <div class="img_wrapper">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 62 62">-->
<!--                                    <defs>-->
<!--                                        <clipPath id="it79a">-->
<!--                                            <path d="M16.825 4.046h2.05v2.049h-2.05zm4.1 0h8.198v2.049h-8.199zm19.47 34.843h2.05v5.124a7.183 7.183 0 0 1-7.173 7.174H16.588l1.262 2.097a7.18 7.18 0 0 1 1.025 3.697v4.444h-2.05v-4.444c0-.93-.254-1.844-.732-2.642l-2.196-3.648a1.024 1.024 0 0 1-.009-1.042l4.612-7.987a2.048 2.048 0 0 0-3.55-2.05L10.338 47.6a1.023 1.023 0 1 1-1.825-.092 7.134 7.134 0 0 1-.911-3.495V30.052l-4.275 9.277a9.075 9.075 0 0 0-.85 3.865v18.24H.429v-18.24a11.135 11.135 0 0 1 1.038-4.727l4.652-10.092a3.077 3.077 0 0 1 1.484-1.476V7.119a7.182 7.182 0 0 1 7.174-7.172h20.496a7.201 7.201 0 0 1 6.211 3.586L39.71 4.558a5.144 5.144 0 0 0-4.437-2.562H14.776A5.13 5.13 0 0 0 9.652 7.12v36.893c0 .205.013.41.038.613l3.485-6.038a4.088 4.088 0 0 1 7.306 3.639 3.07 3.07 0 0 1 2.493-1.288h4.1a3.074 3.074 0 1 1 0 6.148h-4.1a3.074 3.074 0 0 1-3.074-3.074c.004-.332.062-.664.174-.977l-3.524 6.1h18.722a5.13 5.13 0 0 0 5.124-5.123zm-17.421 4.1a1.025 1.025 0 0 0 0 2.049h4.1a1.025 1.025 0 0 0 0-2.05zM58.955 12.06A16.396 16.396 0 0 1 45.53 37.865a17.127 17.127 0 0 1-2.86-.246 16.328 16.328 0 0 1-8.075-3.926l-6.692 1.25c-.397.073-.8-.091-1.035-.42a1.026 1.026 0 0 1-.04-1.106l3.463-5.873c-3.096-7.734.1-16.56 7.43-20.52 7.33-3.96 16.463-1.794 21.234 5.036zm.697 11.897c1.375-7.804-3.837-15.246-11.642-16.622-7.805-1.375-15.247 3.837-16.622 11.643a14.223 14.223 0 0 0 .993 8.239c.125.304.102.648-.06.933l-2.583 4.365 4.99-.933c.061-.008.123-.012.185-.01.262 0 .515.098.707.277a14.349 14.349 0 0 0 24.032-7.892zm-6.959-8.638c.566 0 1.025.458 1.025 1.024v12.298a3.083 3.083 0 0 1-3.074 3.074H40.396a3.083 3.083 0 0 1-3.075-3.074V16.343c0-.566.46-1.024 1.025-1.024h3.075v-1.025a4.099 4.099 0 0 1 8.198 0v1.025zm-9.223 0h4.1v-1.025a2.05 2.05 0 1 0-4.1 0zm8.199 12.297H39.37v1.025c0 .566.46 1.025 1.025 1.025h10.248c.566 0 1.025-.459 1.025-1.025zm0-10.248h-2.05v2.05h-2.05v-2.05H43.47v2.05h-2.05v-2.05h-2.049v8.199h12.298zm-28.995-2.35l-1.578 1.578a5.14 5.14 0 0 1-7.92 6.471 5.14 5.14 0 0 1 6.47-7.92l1.579-1.578zm-2.774 4.4a3.026 3.026 0 0 0-.308-1.318l-3.067 3.066-1.45-1.449 3.067-3.066c-.41-.201-.86-.306-1.317-.308a3.074 3.074 0 1 0 3.075 3.075zm4.099-3.075h4.1v2.05h-4.1zm0 4.1h4.1v2.049h-4.1z"/>-->
<!--                                        </clipPath>-->
<!--                                    </defs>-->
<!--                                    <g>-->
<!--                                        <g>-->
<!--                                            <path class="wrapper_part" fill="#7a7a7a"-->
<!--                                                  d="M16.825 4.046h2.05v2.049h-2.05zm4.1 0h8.198v2.049h-8.199zm19.47 34.843h2.05v5.124a7.183 7.183 0 0 1-7.173 7.174H16.588l1.262 2.097a7.18 7.18 0 0 1 1.025 3.697v4.444h-2.05v-4.444c0-.93-.254-1.844-.732-2.642l-2.196-3.648a1.024 1.024 0 0 1-.009-1.042l4.612-7.987a2.048 2.048 0 0 0-3.55-2.05L10.338 47.6a1.023 1.023 0 1 1-1.825-.092 7.134 7.134 0 0 1-.911-3.495V30.052l-4.275 9.277a9.075 9.075 0 0 0-.85 3.865v18.24H.429v-18.24a11.135 11.135 0 0 1 1.038-4.727l4.652-10.092a3.077 3.077 0 0 1 1.484-1.476V7.119a7.182 7.182 0 0 1 7.174-7.172h20.496a7.201 7.201 0 0 1 6.211 3.586L39.71 4.558a5.144 5.144 0 0 0-4.437-2.562H14.776A5.13 5.13 0 0 0 9.652 7.12v36.893c0 .205.013.41.038.613l3.485-6.038a4.088 4.088 0 0 1 7.306 3.639 3.07 3.07 0 0 1 2.493-1.288h4.1a3.074 3.074 0 1 1 0 6.148h-4.1a3.074 3.074 0 0 1-3.074-3.074c.004-.332.062-.664.174-.977l-3.524 6.1h18.722a5.13 5.13 0 0 0 5.124-5.123zm-17.421 4.1a1.025 1.025 0 0 0 0 2.049h4.1a1.025 1.025 0 0 0 0-2.05zM58.955 12.06A16.396 16.396 0 0 1 45.53 37.865a17.127 17.127 0 0 1-2.86-.246 16.328 16.328 0 0 1-8.075-3.926l-6.692 1.25c-.397.073-.8-.091-1.035-.42a1.026 1.026 0 0 1-.04-1.106l3.463-5.873c-3.096-7.734.1-16.56 7.43-20.52 7.33-3.96 16.463-1.794 21.234 5.036zm.697 11.897c1.375-7.804-3.837-15.246-11.642-16.622-7.805-1.375-15.247 3.837-16.622 11.643a14.223 14.223 0 0 0 .993 8.239c.125.304.102.648-.06.933l-2.583 4.365 4.99-.933c.061-.008.123-.012.185-.01.262 0 .515.098.707.277a14.349 14.349 0 0 0 24.032-7.892zm-6.959-8.638c.566 0 1.025.458 1.025 1.024v12.298a3.083 3.083 0 0 1-3.074 3.074H40.396a3.083 3.083 0 0 1-3.075-3.074V16.343c0-.566.46-1.024 1.025-1.024h3.075v-1.025a4.099 4.099 0 0 1 8.198 0v1.025zm-9.223 0h4.1v-1.025a2.05 2.05 0 1 0-4.1 0zm8.199 12.297H39.37v1.025c0 .566.46 1.025 1.025 1.025h10.248c.566 0 1.025-.459 1.025-1.025zm0-10.248h-2.05v2.05h-2.05v-2.05H43.47v2.05h-2.05v-2.05h-2.049v8.199h12.298zm-28.995-2.35l-1.578 1.578a5.14 5.14 0 0 1-7.92 6.471 5.14 5.14 0 0 1 6.47-7.92l1.579-1.578zm-2.774 4.4a3.026 3.026 0 0 0-.308-1.318l-3.067 3.066-1.45-1.449 3.067-3.066c-.41-.201-.86-.306-1.317-.308a3.074 3.074 0 1 0 3.075 3.075zm4.099-3.075h4.1v2.05h-4.1zm0 4.1h4.1v2.049h-4.1z"/>-->
<!--                                        </g>-->
<!--                                        <g clip-path="url(#it79a)">-->
<!--                                            <path class="inner_part" fill="#ff4342"-->
<!--                                                  d="M45.136 9.494c6.668 0 12.073 5.406 12.073 12.074s-5.405 12.074-12.073 12.074c-6.669 0-12.074-5.406-12.074-12.074S38.467 9.494 45.136 9.494z"/>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </svg>-->
<!--                            </div><!-- .img_wrapper -->-->
<!--                            <div class="text_wrapper">-->
<!--                                <h4>طراحی اپلیکیشن</h4>-->
<!--                                <span>App design</span>-->
<!--                            </div><!-- .text_wrapper -->-->
<!--                        </div><!-- .item -->-->
<!--                    </div><!-- .col-lg-8 -->-->
<!--                    <div class="col-md-24 col-lg-8">-->
<!--                        <div class="item">-->
<!--                            <div class="img_wrapper">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="47" viewBox="0 0 71 47">-->
<!--                                    <defs>-->
<!--                                        <clipPath id="2knka">-->
<!--                                            <path d="M1.404 42.885C.438 40.603 0 37.357.175 32.88c.176-4.037.878-8.512 1.93-12.725.966-4.037 2.37-7.81 3.95-10.707C12.198-1.434 18.868.321 26.855 2.34c2.544.615 5.265 1.316 8.073 1.58h.878c2.808-.264 5.529-.965 8.073-1.58 7.987-2.106 14.656-3.774 20.8 7.02 1.58 2.897 2.896 6.67 3.949 10.708 1.053 4.212 1.755 8.688 1.93 12.725.176 4.564-.263 7.81-1.228 10.004-.965 2.282-2.457 3.51-4.213 4.037-1.667.438-3.598.175-5.616-.615-3.423-1.403-7.372-4.387-11.234-7.985-2.72-2.633-7.81-3.95-12.9-3.95-5.09 0-10.18 1.317-12.9 3.95-3.862 3.598-7.812 6.582-11.234 7.985-2.019.879-3.95 1.053-5.617.615-1.843-.526-3.247-1.842-4.212-3.949zM4.3 41.393c.526 1.228 1.228 1.931 2.106 2.194.965.351 2.194.087 3.598-.439 2.984-1.14 6.582-3.95 10.18-7.284 3.423-3.159 9.303-4.826 15.183-4.826 5.88 0 11.76 1.667 15.095 5.001 3.51 3.335 7.108 6.056 10.18 7.285 1.404.526 2.632.702 3.598.439.877-.263 1.58-.966 2.106-2.195.79-1.842 1.14-4.563.965-8.6-.175-3.862-.877-8.073-1.843-12.111-.965-3.861-2.194-7.284-3.686-9.917C56.956 2.252 51.34 3.744 44.67 5.41c-2.72.703-5.529 1.405-8.688 1.668H34.665c-3.072-.263-5.88-.965-8.6-1.668-6.67-1.755-12.287-3.16-17.114 5.529-1.492 2.633-2.72 6.144-3.686 9.917a60.555 60.555 0 0 0-1.843 12.111c-.175 4.037.176 6.758.878 8.425zm6.406-18.517a5.18 5.18 0 0 1-1.492-3.598c0-1.405.527-2.634 1.492-3.599l.088-.088c.878-.789 1.93-1.316 3.16-1.403.087-1.23.702-2.37 1.491-3.16a5.182 5.182 0 0 1 3.599-1.492c1.404 0 2.632.526 3.598 1.492l.087.088c.79.79 1.317 1.93 1.405 3.072 1.228.087 2.281.701 3.159 1.491a5.18 5.18 0 0 1 1.492 3.599 4.97 4.97 0 0 1-1.492 3.598c-.79.877-1.93 1.404-3.16 1.492-.087 1.228-.701 2.282-1.491 3.159a5.182 5.182 0 0 1-3.598 1.492 4.969 4.969 0 0 1-3.599-1.492c-.877-.79-1.404-1.93-1.492-3.16-1.316-.087-2.37-.614-3.247-1.491zm1.756-3.598c0 .526.263.965.526 1.228.351.35.79.526 1.317.526h1.228c.965 0 1.668.79 1.668 1.668v1.229c0 .526.175.966.526 1.316.351.351.79.527 1.316.527.527 0 .966-.176 1.317-.527.35-.35.526-.79.526-1.316v-1.14c0-.966.79-1.668 1.668-1.668h1.228c.527 0 .966-.176 1.317-.527.35-.35.526-.79.526-1.316 0-.527-.175-.966-.526-1.317-.351-.35-.79-.527-1.317-.527h-1.228c-.965 0-1.668-.79-1.668-1.667v-1.228c0-.44-.175-.878-.438-1.229l-.088-.088c-.351-.35-.79-.526-1.317-.526-.526 0-.965.176-1.316.526-.35.351-.526.79-.526 1.317v1.228c0 .966-.79 1.667-1.668 1.667h-1.229c-.438 0-.877.176-1.228.44l-.088.087c-.351.35-.526.79-.526 1.317zm38.175-9.303a3.071 3.071 0 1 1 0 6.143 3.071 3.071 0 0 1 0-6.143zm0 12.462a3.071 3.071 0 1 1 0 6.143 3.071 3.071 0 0 1 0-6.143zm-6.23-6.231a3.072 3.072 0 1 1-.002 6.144 3.072 3.072 0 0 1 .001-6.144zm12.46 0a3.072 3.072 0 1 1 0 6.144 3.072 3.072 0 0 1 0-6.144z"/>-->
<!--                                        </clipPath>-->
<!--                                    </defs>-->
<!--                                    <g>-->
<!--                                        <g>-->
<!--                                            <path class="wrapper_part" fill="#7a7a7a"-->
<!--                                                  d="M1.404 42.885C.438 40.603 0 37.357.175 32.88c.176-4.037.878-8.512 1.93-12.725.966-4.037 2.37-7.81 3.95-10.707C12.198-1.434 18.868.321 26.855 2.34c2.544.615 5.265 1.316 8.073 1.58h.878c2.808-.264 5.529-.965 8.073-1.58 7.987-2.106 14.656-3.774 20.8 7.02 1.58 2.897 2.896 6.67 3.949 10.708 1.053 4.212 1.755 8.688 1.93 12.725.176 4.564-.263 7.81-1.228 10.004-.965 2.282-2.457 3.51-4.213 4.037-1.667.438-3.598.175-5.616-.615-3.423-1.403-7.372-4.387-11.234-7.985-2.72-2.633-7.81-3.95-12.9-3.95-5.09 0-10.18 1.317-12.9 3.95-3.862 3.598-7.812 6.582-11.234 7.985-2.019.879-3.95 1.053-5.617.615-1.843-.526-3.247-1.842-4.212-3.949zM4.3 41.393c.526 1.228 1.228 1.931 2.106 2.194.965.351 2.194.087 3.598-.439 2.984-1.14 6.582-3.95 10.18-7.284 3.423-3.159 9.303-4.826 15.183-4.826 5.88 0 11.76 1.667 15.095 5.001 3.51 3.335 7.108 6.056 10.18 7.285 1.404.526 2.632.702 3.598.439.877-.263 1.58-.966 2.106-2.195.79-1.842 1.14-4.563.965-8.6-.175-3.862-.877-8.073-1.843-12.111-.965-3.861-2.194-7.284-3.686-9.917C56.956 2.252 51.34 3.744 44.67 5.41c-2.72.703-5.529 1.405-8.688 1.668H34.665c-3.072-.263-5.88-.965-8.6-1.668-6.67-1.755-12.287-3.16-17.114 5.529-1.492 2.633-2.72 6.144-3.686 9.917a60.555 60.555 0 0 0-1.843 12.111c-.175 4.037.176 6.758.878 8.425zm6.406-18.517a5.18 5.18 0 0 1-1.492-3.598c0-1.405.527-2.634 1.492-3.599l.088-.088c.878-.789 1.93-1.316 3.16-1.403.087-1.23.702-2.37 1.491-3.16a5.182 5.182 0 0 1 3.599-1.492c1.404 0 2.632.526 3.598 1.492l.087.088c.79.79 1.317 1.93 1.405 3.072 1.228.087 2.281.701 3.159 1.491a5.18 5.18 0 0 1 1.492 3.599 4.97 4.97 0 0 1-1.492 3.598c-.79.877-1.93 1.404-3.16 1.492-.087 1.228-.701 2.282-1.491 3.159a5.182 5.182 0 0 1-3.598 1.492 4.969 4.969 0 0 1-3.599-1.492c-.877-.79-1.404-1.93-1.492-3.16-1.316-.087-2.37-.614-3.247-1.491zm1.756-3.598c0 .526.263.965.526 1.228.351.35.79.526 1.317.526h1.228c.965 0 1.668.79 1.668 1.668v1.229c0 .526.175.966.526 1.316.351.351.79.527 1.316.527.527 0 .966-.176 1.317-.527.35-.35.526-.79.526-1.316v-1.14c0-.966.79-1.668 1.668-1.668h1.228c.527 0 .966-.176 1.317-.527.35-.35.526-.79.526-1.316 0-.527-.175-.966-.526-1.317-.351-.35-.79-.527-1.317-.527h-1.228c-.965 0-1.668-.79-1.668-1.667v-1.228c0-.44-.175-.878-.438-1.229l-.088-.088c-.351-.35-.79-.526-1.317-.526-.526 0-.965.176-1.316.526-.35.351-.526.79-.526 1.317v1.228c0 .966-.79 1.667-1.668 1.667h-1.229c-.438 0-.877.176-1.228.44l-.088.087c-.351.35-.526.79-.526 1.317zm38.175-9.303a3.071 3.071 0 1 1 0 6.143 3.071 3.071 0 0 1 0-6.143zm0 12.462a3.071 3.071 0 1 1 0 6.143 3.071 3.071 0 0 1 0-6.143zm-6.23-6.231a3.072 3.072 0 1 1-.002 6.144 3.072 3.072 0 0 1 .001-6.144zm12.46 0a3.072 3.072 0 1 1 0 6.144 3.072 3.072 0 0 1 0-6.144z"/>-->
<!--                                        </g>-->
<!--                                        <g clip-path="url(#2knka)">-->
<!--                                            <path class="inner_part" fill="#ff4342"-->
<!--                                                  d="M50.829 8.992c6.567 0 11.89 5.324 11.89 11.891 0 6.566-5.323 11.89-11.89 11.89s-11.89-5.324-11.89-11.89c0-6.567 5.324-11.89 11.89-11.89z"/>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </svg>-->
<!--                            </div><!-- .img_wrapper -->-->
<!--                            <div class="text_wrapper">-->
<!--                                <h4>بازی های برندساز</h4>-->
<!--                                <span>Brand maker games</span>-->
<!--                            </div><!-- .text_wrapper -->-->
<!--                        </div><!-- .item -->-->
<!--                    </div><!-- .col-lg-8 -->-->
<!--                    <div class="col-md-24 col-lg-8">-->
<!--                        <div class="item">-->
<!--                            <div class="img_wrapper">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="82" height="71" viewBox="0 0 82 71">-->
<!--                                    <defs>-->
<!--                                        <clipPath id="4lhva">-->
<!--                                            <path d="M71.04 31.739a1.245 1.245 0 0 1 1.764 0l8.444 8.443a1.247 1.247 0 0 1 0 1.763l-4.626 4.626a1.274 1.274 0 0 1-.035.035l-18.981 18.98a1.242 1.242 0 0 1-.512.31l-12.64 4.213a1.246 1.246 0 0 1-1.577-1.576l4.138-12.414H9.186c-4.614 0-8.37-3.755-8.37-8.37V8.823c0-4.616 3.756-8.37 8.37-8.37h46.298c4.616 0 8.37 3.754 8.37 8.37v30.104zm7.563 9.325l-6.68-6.681-2.882 2.881 6.681 6.68zM50.044 56.262l6.68 6.68L73.96 45.708l-6.68-6.68-3.771 3.77a1.246 1.246 0 0 1-.039.04L50.566 55.74a1.272 1.272 0 0 1-.027.026zM46.03 66.956l8.387-2.796-5.59-5.59zM61.361 8.822a5.883 5.883 0 0 0-5.877-5.877H9.186A5.883 5.883 0 0 0 3.31 8.822v6.115H61.36zM3.31 47.75a5.882 5.882 0 0 0 5.876 5.875h39.969L61.36 41.42v-23.99H3.31zM15.207 9a3.488 3.488 0 0 1 3.484-3.485 3.488 3.488 0 0 1 3.484 3.484 3.487 3.487 0 0 1-3.484 3.484 3.488 3.488 0 0 1-3.484-3.484zM17.7 9a.992.992 0 0 0 1.983 0A.992.992 0 0 0 17.7 9zM5.157 8.967A3.487 3.487 0 0 1 8.64 5.484a3.487 3.487 0 0 1 3.484 3.484A3.487 3.487 0 0 1 8.64 12.45a3.487 3.487 0 0 1-3.483-3.483zm2.493 0a.992.992 0 0 0 1.982 0 .992.992 0 0 0-1.982 0zm17.608.063a3.488 3.488 0 0 1 3.484-3.485 3.488 3.488 0 0 1 3.484 3.485 3.487 3.487 0 0 1-3.484 3.483 3.487 3.487 0 0 1-3.484-3.483zm2.493 0a.992.992 0 0 0 1.982 0 .992.992 0 0 0-1.982 0z"/>-->
<!--                                        </clipPath>-->
<!--                                    </defs>-->
<!--                                    <g>-->
<!--                                        <g>-->
<!--                                            <path class="wrapper_part" fill="#7a7a7a"-->
<!--                                                  d="M71.04 31.739a1.245 1.245 0 0 1 1.764 0l8.444 8.443a1.247 1.247 0 0 1 0 1.763l-4.626 4.626a1.274 1.274 0 0 1-.035.035l-18.981 18.98a1.242 1.242 0 0 1-.512.31l-12.64 4.213a1.246 1.246 0 0 1-1.577-1.576l4.138-12.414H9.186c-4.614 0-8.37-3.755-8.37-8.37V8.823c0-4.616 3.756-8.37 8.37-8.37h46.298c4.616 0 8.37 3.754 8.37 8.37v30.104zm7.563 9.325l-6.68-6.681-2.882 2.881 6.681 6.68zM50.044 56.262l6.68 6.68L73.96 45.708l-6.68-6.68-3.771 3.77a1.246 1.246 0 0 1-.039.04L50.566 55.74a1.272 1.272 0 0 1-.027.026zM46.03 66.956l8.387-2.796-5.59-5.59zM61.361 8.822a5.883 5.883 0 0 0-5.877-5.877H9.186A5.883 5.883 0 0 0 3.31 8.822v6.115H61.36zM3.31 47.75a5.882 5.882 0 0 0 5.876 5.875h39.969L61.36 41.42v-23.99H3.31zM15.207 9a3.488 3.488 0 0 1 3.484-3.485 3.488 3.488 0 0 1 3.484 3.484 3.487 3.487 0 0 1-3.484 3.484 3.488 3.488 0 0 1-3.484-3.484zM17.7 9a.992.992 0 0 0 1.983 0A.992.992 0 0 0 17.7 9zM5.157 8.967A3.487 3.487 0 0 1 8.64 5.484a3.487 3.487 0 0 1 3.484 3.484A3.487 3.487 0 0 1 8.64 12.45a3.487 3.487 0 0 1-3.483-3.483zm2.493 0a.992.992 0 0 0 1.982 0 .992.992 0 0 0-1.982 0zm17.608.063a3.488 3.488 0 0 1 3.484-3.485 3.488 3.488 0 0 1 3.484 3.485 3.487 3.487 0 0 1-3.484 3.483 3.487 3.487 0 0 1-3.484-3.483zm2.493 0a.992.992 0 0 0 1.982 0 .992.992 0 0 0-1.982 0z"/>-->
<!--                                        </g>-->
<!--                                        <g clip-path="url(#4lhva)">-->
<!--                                            <path class="inner_part" fill="#ff4342"-->
<!--                                                  d="M46.453 56.45L42.78 69.413l.81 1.782s22.74-1.998 23.063-2.646c.324-.648 18.58-23.55 18.743-24.198.162-.648-7.832-13.395-7.832-13.395l-5.617-.594-7.832 8.21z"/>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </svg>-->
<!--                            </div><!-- .img_wrapper -->-->
<!--                            <div class="text_wrapper">-->
<!--                                <h4>تولید محتوا</h4>-->
<!--                                <span>Content production</span>-->
<!--                            </div><!-- .text_wrapper -->-->
<!--                        </div><!-- .item -->-->
<!--                    </div><!-- .col-lg-8 -->-->
<!--                </div><!-- .row -->-->
<!--            </div><!-- .services_card__wrapper -->-->
<!--        </div><!-- .container -->-->
<!--    </section><!-- .services_card -->-->
<!--    --><?php
//    return ob_get_clean();
//}
//
//add_shortcode('services_card', 'services_card_shortcode');

function podcast_shortcode()
{
    ob_start();
    ?>
    <section class="podcast">
        <div class="container">
            <div class="row">
                <div class="col-md-24">
                    <div class="podcast__container">
                        <div class="podcast_img_wrapper">
                            <img src="http://127.0.0.1:3020/wp-content/uploads/2020/09/podcast.jpg"
                                 alt="podcast image">
                        </div><!-- .podcast_img_wrapper -->
                        <div class="podcast_wrapper" data-audio-link="<?php the_field('podcast_audio'); ?>">
                            <div class="podcast_details">
                                <div class="podcast_title">
                                    <h4><?php the_field('podcast_title'); ?></h4>
                                    <span><?php the_field('podcast_topic'); ?></span>
                                </div><!-- .podcast_title -->
                                <button class="podcast_button paused">
                                    <span class="icon-play"></span>
                                    <svg class="progress-ring">
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

add_shortcode('podcast', 'podcast_shortcode');

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
        <img class="videos__background" src="http://127.0.0.1:3020/wp-content/uploads/2020/09/dots-gray.png"
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

