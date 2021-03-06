<?php

add_action('wp_enqueue_scripts', 'ivahid_landing_resources');
function ivahid_landing_resources()
{
    if (is_page_template('page-ivahid.php') || is_page_template('page-ivahid-copy.php')) {
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, true);
        wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);
    }
//    if (is_page_template('page-ivahid-copy.php')) {
//        wp_enqueue_style('ivahid_style_yekan_font', get_template_directory_uri() . '/assets/css/ivahid_style_yekan_font.css');
//    }
}

//functions
function StrToArr($str, $delimiter)
{
    $arr = explode($delimiter, $str);
    $result = [];
    foreach ($arr as $item) {
        $result[] = trim($item);
    }
    return $result;
}

// shortcodes
if ( class_exists( 'ACF' ) ) {
// contact bar
    function contact_bar_shortcode($atts)
    {
        ob_start();
        $attributes = shortcode_atts(
            array(
                'text' => '',
                'button_title' => '',
                'button_url' => '',
                'area_code' => '',
                'tel' => ''
            ),
            $atts
        );
        ?>
        </div><!-- .container -->
        <div class="free-consultation">
            <div class="container">
                <div class="row p30 align-items-center">
                    <div class="col-md-13 col-24">
                        <?php
                        if ($attributes['text']) {
                            ?>
                            <p class="consultation-content">
                                <?php
                                echo esc_html($attributes['text']);
                                ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="col-md-11 col-24">
                        <div class="consultation-contact">
                            <div class="consultation-contact__button">
                                <?php if ($attributes['button_url']) { ?>
                                    <a href="<?php echo esc_url($attributes['button_url']); ?>">
                                        <?php echo esc_html($attributes['button_title']); ?>
                                    </a>
                                <?php } ?>
                            </div>
                            <p class="consultation-contact__tel">
                                <?php if ($attributes['area_code']) { ?>
                                    <span><?php echo esc_html($attributes['area_code']); ?></span>
                                <?php } ?>

                                <?php if ($attributes['tel']) {
                                    ?>
                                    <span><?php echo esc_html($attributes['tel']); ?></span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('contact_bar', 'contact_bar_shortcode');

//web design sec
    function web_design_sec_shortcode()
    {
        ob_start(); ?>
        </div><!-- .container -->
        <section class="web_design_sec">
            <div class="web_design_sec__content_wrapper">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-9">
                            <div class="web_design_sec__content">
                                <div class="title title--red">
                                    <?php if (get_field('web_design_sec_title_fa')) { ?>
                                        <h1><?php the_field('web_design_sec_title_fa'); ?></h1>
                                    <?php } ?>

                                    <?php if (get_field('web_design_sec_title_en')) { ?>
                                        <p><?php the_field('web_design_sec_title_en'); ?></p>
                                    <?php } ?>
                                </div><!-- .title -->
                                    <?php the_field('web_design_sec_description'); ?>
                            </div><!-- .web_design_sec__content -->
                            <div class="text-center">
                                <?php
                                $web_design_sec_link = get_field('web_design_sec_link');
                                if ($web_design_sec_link) {
                                    ?>
                                    <a href="<?php echo esc_url($web_design_sec_link['url']); ?>"
                                       class="web_design_sec_link"><?php echo esc_html($web_design_sec_link['title']); ?></a>
                                <?php } ?>
                            </div>
                        </div><!-- .col-xl-9 -->
                        <div class="col-xl-15">
                            <div class="web_design_sec__img_wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/img/web_design_sec.png' ?>"
                                     alt="web design">
                                <div class="web_design_sec_video_wrapper">
                                    <video id="web_design_sec_video" preload="none"
                                        <?php $video_poster_link = get_field( 'web_design_sec_video_poster' ); ?>
                                        <?php if ( $video_poster_link ){ ?>
                                            poster="<?php echo esc_url( $video_poster_link ); ?>"
                                        <?php } ?>>

                                        <?php $video_link = get_field('web_design_sec_video');
                                        if ($video_link) { ?>
                                            <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
                                        <?php } ?>
                                        Your browser does not support HTML video.
                                    </video>
                                    <button class="web_design_sec_video_btn btn_visible paused">
                                        <span class="icon-play"></span>
                                    </button><!-- .web_design_sec_video_btn -->
                                </div><!-- .web_design_sec_slider -->
                            </div><!-- .web_design_sec__img_wrapper -->
                        </div><!-- .col-xl-15 -->
                    </div><!-- .row -->
                </div><!-- .container-->
            </div><!-- .web_design_sec__content_wrapper -->
            <div class="go_bottom_wrapper">
                <a class="go_bottom" href="#">
                    <span class="icon-arrow-bottom"></span>
                </a><!-- .web_design_sec__go_bottom -->
            </div><!-- .go_bottom_wrapper -->
        </section><!-- .web_design_sec -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('web_design_sec', 'web_design_sec_shortcode');

// your position
    function your_position_shortcode()
    {
        ob_start(); ?>
        </div><!-- .container -->
        <section class="your_position">
            <div class="outer_text_wrapper">
                <div class="container">
                    <div class="text">
                        <div class="title">

                            <?php if (get_field('your_position_title_fa')) { ?>
                                <h3><?php the_field('your_position_title_fa'); ?></h3>
                            <?php } ?>

                            <?php if (get_field('your_position_title_en')) { ?>
                                <p><?php the_field('your_position_title_en'); ?></p>
                            <?php } ?>

                        </div><!-- .title -->
                        <?php the_field('your_position_description'); ?>
                    </div><!-- .text -->
                </div><!-- .container -->
            </div><!-- .outer_text_wrapper -->
            <div class="your_position__content_wrapper">
                <img class="background"
                     src="<?php echo get_template_directory_uri() . '/img/your_position_back_2.png' ?>"
                     alt="your position background">
                <div class="your_position__container">
                    <div class="col-lg-21">
                        <div class="inner_text_wrapper">
                            <div class="text">
                                <div class="title">

                                    <?php if (get_field('your_position_title_fa')) { ?>
                                        <h3><?php the_field('your_position_title_fa'); ?></h3>
                                    <?php } ?>

                                    <?php if (get_field('your_position_title_en')) { ?>
                                        <p><?php the_field('your_position_title_en'); ?></p>
                                    <?php } ?>

                                </div><!-- .title -->
                            <?php the_field('your_position_description'); ?>
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
                                    wp_reset_postdata();
                                }
                            }
                            ?>
                        </div><!-- .swiper-wrapper -->
                    </div><!-- .categories_description_list -->
                </div><!-- .your_position_wrapper -->
            </div><!-- .image_container -->
        </section><!-- .your_position -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('your_position', 'your_position_shortcode');

//services
    function services_shortcode()
    {
        ob_start(); ?>
        </div><!-- .container -->
        <section class="services">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-24">
                        <div class="services__content">
                            <div class="title">

                                <?php if (get_field('services_title_fa')) { ?>
                                    <h2><?php the_field('services_title_fa'); ?></h2>
                                <?php } ?>

                                <?php if (get_field('services_title_en')) { ?>
                                    <p><?php the_field('services_title_en'); ?></p>
                                <?php } ?>

                            </div><!-- .title -->
                            <?php the_field('services_description'); ?>
                        </div><!-- .services_content -->
                    </div><!-- .col-24 -->
                    <?php
                    if (have_rows('services_list')) { ?>
                        <div class="row p30">
                            <?php
                            while (have_rows('services_list')) {
                                the_row();
                                ?>
                                <div class="col-lg-8 col-md-12 col-24">
                                    <div class="services__item">
                                        <div class="item_title_wrapper">
                                            <div class="services_icon">
                                                <?php
                                                $item_image = get_sub_field( 'service_image' );
                                                if ( $item_image ) {
                                                    ?>
                                                    <img src="<?php echo esc_url( $item_image['url'] ); ?>"
                                                         alt="<?php echo esc_attr( $item_image['alt'] ); ?>">
                                                <?php } ?>
                                            </div>
                                            <div class="title">
                                                <?php
                                                $main_title_link = get_sub_field('main_title_link');
                                                $subtitle_link = get_sub_field('subtitle_link');
                                                $item_link = get_sub_field('item_link');
                                                ?>
                                                <p>
                                                    <?php if ($main_title_link) { ?>
                                                        <a href="<?php echo esc_url($main_title_link['url']); ?>"><?php echo esc_html($main_title_link['title']); ?></a>
                                                    <?php } ?>
                                                </p>
                                                <p>
                                                    <?php if ($subtitle_link) { ?>
                                                        <a href="<?php echo esc_url($subtitle_link['url']); ?>"><?php echo esc_html($subtitle_link['title']); ?></a>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </div><!-- .item_title_wrapper -->
                                        <div class="item_content">

                                            <?php if (get_sub_field('item_description')) { ?>
                                                <p><?php echo get_sub_field('item_description'); ?></p>
                                            <?php } ?>

                                            <?php if ($item_link) { ?>
                                                <a href="<?php echo esc_url($item_link['url']); ?>"
                                                   class="read_more"><?php echo esc_html($item_link['title']); ?></a>
                                            <?php } ?>

                                        </div>
                                    </div><!-- .services__item -->
                                </div><!-- .col-lg-8-->
                                <?php
                            } ?>
                        </div><!-- .row -->
                        <?php
                    }
                    ?>
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .services -->
        <div class="container">
        <?php return ob_get_clean();
    }

    add_shortcode('services', 'services_shortcode');

    function design_effect_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="design_effect">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-md-12 col-24">
                        <div class="design_effect__img">
                            <?php $design_effect_image = get_field('design_effect_image');
                            if ($design_effect_image) { ?>
                                <img src="<?php echo esc_url($design_effect_image['url']) ?>"
                                     alt="<?php echo esc_attr($design_effect_image['alt']); ?>">
                            <?php } ?>
                        </div><!-- .img -->
                    </div><!-- .col-xl-12 -->
                    <div class="col-xl-12 col-md-12 col-24">
                        <div class="design_effect__content">
                            <div class="title title--red">

                                <?php if (get_field('design_effect_title_fa')) { ?>
                                    <h3><?php the_field('design_effect_title_fa'); ?></h3>
                                <?php } ?>

                                <?php if (get_field('design_effect_title_en')) { ?>
                                    <p><?php the_field('design_effect_title_en'); ?></p>
                                <?php } ?>
                            </div><!-- .title -->
                            <?php the_field('design_effect_description'); ?>
                        </div><!-- .design_effect__content -->
                    </div>
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .design_effect -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('design_effect', 'design_effect_shortcode');

    function select_team_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="select_team">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-24">
                        <div class="select_team__img">
                            <?php
                            $select_team_img = get_field('select_team_img');
                            if (!empty($select_team_img)) {
                                ?>
                                <img src="<?php echo esc_url($select_team_img['url']); ?>"
                                     alt="<?php echo esc_attr($select_team_img['alt']); ?>">
                                <?php
                            }
                            ?>
                            <div class="select_team__img__label">
                                <div class="select_team_icon">
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
                                        <?php if (get_field('select_team_title_fa')) { ?>
                                            <h3><?php the_field('select_team_title_fa') ?></h3>
                                        <?php } ?>

                                        <?php if (get_field('select_team_title_en')) { ?>
                                            <p><?php the_field('select_team_title_en'); ?></p>
                                        <?php } ?>
                                    </div><!-- .title -->
                                    <?php the_field('select_team_description'); ?>
                                </div><!-- .select_team__content -->
                            </div><!-- .col-lg-12 -->
                        </div><!-- .row -->
                    </div><!-- .col-xl-24 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .select_team -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('select_team', 'select_team_shortcode');

    function ivahid_difference_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="ivahid_difference">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="ivahid_difference__img">
                            <?php
                            $ivahid_difference_img = get_field('ivahid_difference_img');
                            if (!empty($ivahid_difference_img)) {
                                ?>
                                <img src="<?php echo esc_url($ivahid_difference_img['url']); ?>"
                                     alt="<?php echo esc_attr($ivahid_difference_img['alt']); ?>">
                                <?php
                            }
                            ?>
                        </div><!-- .ivahid_difference__img -->
                    </div><!-- .col-xl-9 -->
                    <div class="col-xl-15 col-lg-15 col-md-12">
                        <div class="ivahid_difference__content">
                            <div class="title">
                                <?php if (get_field('ivahid_difference_title_fa')) { ?>
                                    <h3><?php the_field('ivahid_difference_title_fa'); ?></h3>
                                <?php } ?>

                                <?php if (get_field('ivahid_difference_title_en')) { ?>
                                    <p><?php the_field('ivahid_difference_title_en'); ?></p>
                                <?php } ?>

                            </div><!-- .title -->
                            <?php the_field('ivahid_difference_description'); ?>
                        </div><!-- .ivahid_difference__content -->
                    </div><!-- .col-xl-15 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .ivahid_difference -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('ivahid_difference', 'ivahid_difference_shortcode');

    function ivahid_difference_shortcode2()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="ivahid_difference">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="ivahid_difference__img">
                            <?php
                            $ivahid_difference_img = get_field('ivahid_difference_img2');
                            if (!empty($ivahid_difference_img)) {
                                ?>
                                <img src="<?php echo esc_url($ivahid_difference_img['url']); ?>"
                                     alt="<?php echo esc_attr($ivahid_difference_img['alt']); ?>">
                                <?php
                            }
                            ?>
                        </div><!-- .ivahid_difference__img -->
                    </div><!-- .col-xl-9 -->
                    <div class="col-xl-15 col-lg-15 col-md-12">
                        <div class="ivahid_difference__content">
                            <div class="title">
                                <?php if (get_field('ivahid_difference_title_fa2')) { ?>
                                    <h3><?php the_field('ivahid_difference_title_fa2'); ?></h3>
                                <?php } ?>

                                <?php if (get_field('ivahid_difference_title_en2')) { ?>
                                    <p><?php the_field('ivahid_difference_title_en2'); ?></p>
                                <?php } ?>

                            </div><!-- .title -->
                            <?php the_field('ivahid_difference_description2'); ?>
                        </div><!-- .ivahid_difference__content -->
                    </div><!-- .col-xl-15 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .ivahid_difference -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('new_section', 'ivahid_difference_shortcode2');

    function portal_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
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
                                        <?php if (get_field('portal_title')) { ?>
                                            <h3><?php the_field('portal_title'); ?></h3>
                                        <?php } ?>
                                    </div><!-- .title -->
                                    <?php the_field('portal_description'); ?>
                                    <div class="link">
                                        <?php
                                        $portal_link = get_field('portal_link');
                                        $url = $portal_link['url'];
                                        $title = $portal_link['title'];
                                        ?>
                                        <?php if ($portal_link) { ?>
                                            <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
                                        <?php } ?>
                                    </div>
                                </div><!-- .portal__content -->
                            </div><!-- .col-lg-12 -->
                        </div><!-- .row -->
                    </div><!-- .col-md-24 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .portal -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('portal', 'portal_shortcode');

    function services_card_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="services_card">
            <div class="container">
                <div class="title">

                    <?php if (get_field('services_card_title_fa')) { ?>
                        <h3><?php the_field('services_card_title_fa'); ?></h3>
                    <?php } ?>

                    <?php if (get_field('services_card_title_en')) { ?>
                        <p><?php the_field('services_card_title_en') ?></p>
                    <?php } ?>

                </div><!-- .title -->
                <div class="services_card__wrapper">
                    <div class="row p30">
                        <?php
                        if (have_rows('services_cards')) {
                            while (have_rows('services_cards')) {
                                the_row();
                                ?>
                                <div class="col-lg-6 col-md-12 col-24">
                                    <?php if ( get_sub_field( 'services_card_link' ) ) { ?>
                                        <a href="<?php echo get_sub_field( 'services_card_link' ); ?>">
                                    <?php } ?>
                                        <div class="item">
                                            <div class="img_wrapper">
                                                <?php echo get_sub_field('services_card_svg'); ?>
                                            </div><!-- .img_wrapper -->
                                            <div class="text_wrapper">
                                                <h4><?php echo get_sub_field('services_card_title_fa'); ?></h4>
                                                <span><?php echo get_sub_field('services_card_title_en'); ?></span>
                                            </div><!-- .text_wrapper -->
                                        </div><!-- .item -->
                                        <?php if ( get_sub_field( 'services_card_link' ) ) { ?>
                                            </a><!-- .services_card_link -->
                                        <?php } ?>
                                </div><!-- .col-lg-6 -->
                                <?php
                            }
                        }
                        ?>
                    </div><!-- .row -->
                </div><!-- .services_card__wrapper -->
            </div><!-- .container -->
        </section><!-- .services_card -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('services_card', 'services_card_shortcode');

    function podcast_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="podcast">
            <div class="container">
                <div class="podcast__container">
                    <div class="podcast_img_wrapper">
                        <img src="<?php echo get_template_directory_uri() . '/img/podcast.jpg'; ?>" alt="podcast">
                    </div><!-- .podcast_img_wrapper -->
                    <div class="podcast_wrapper" data-audio-link="<?php the_field('podcast_audio'); ?>">
                        <div class="podcast_details">
                            <div class="podcast_title">
                                <?php
                                $podcast_title_link = get_field('podcast_title_link');
                                $podcast_topic_link = get_field('podcast_topic_link');
                                ?>
                                <?php if ($podcast_title_link) { ?>
                                    <h4>
                                        <a href="<?php echo esc_url($podcast_title_link['url']); ?>"><?php echo esc_html($podcast_title_link['title']); ?></a>
                                    </h4>
                                <?php } ?>

                                <?php if ($podcast_topic_link) { ?>
                                    <span><a href="<?php echo esc_url($podcast_topic_link['url']); ?>"><?php echo esc_html($podcast_topic_link['title']); ?></a></span>
                                <?php } ?>

                            </div><!-- .podcast_title -->
                            <button class="podcast_button paused">
                                <span class="icon-play"></span>
                                <svg class="progress-ring">
                                    <circle
                                            class="progress-ring__circle"
                                            stroke="#ff4342"
                                            stroke-width="2"
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
                            <span class="current_time">00:00</span>
                        </div><!-- .waveform_wrapper -->
                    </div><!-- .podcast_wrapper -->
                </div><!-- .podcast__container -->
            </div><!-- .container -->
        </section><!-- .podcast -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('podcast', 'podcast_shortcode');

    function customers_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="customers">
            <div class="container">
                <div class="customers__wrapper">
                    <div class="swiper-container">
                        <div class="title">

                            <?php if (get_field('customers_title_fa')) { ?>
                                <h3><?php the_field('customers_title_fa'); ?></h3>
                            <?php } ?>

                            <?php if (get_field('customers_title_en')) { ?>
                                <p><?php the_field('customers_title_en'); ?></p>
                            <?php } ?>

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
                                            <?php
                                            if (!empty($logo)) {
                                                ?>
                                                <img src="<?php echo esc_url($logo['url']); ?>"
                                                     alt="<?php echo esc_attr($logo['alt']); ?>">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div><!-- .swiper-wrapper -->
                    </div><!-- .swiper-container -->
                </div><!-- .customers__wrapper -->
            </div><!-- .container -->
        </section><!-- .customers -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('customers', 'customers_shortcode');

    function portfolio_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-24">
                        <div class="portfolio__background">
                            <span></span>
                            <span></span>
                        </div>
                        <div class="title title--black">

                            <?php if (get_field('portfolio_title')) { ?>
                                <h2><?php the_field('portfolio_title'); ?></h2>
                            <?php } ?>

                        </div><!-- .title -->
                        <div class="portfolio__description">
                            <?php the_field('portfolio_description'); ?>
                        </div><!-- .portfolio__description -->
                        <div class="portfolio__wrapper">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php
                                    if (have_rows('portfolio_items')) {
                                        while (have_rows('portfolio_items')) {
                                            the_row();
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="portfolio__wrapper__item">
                                                    <a href="<?php $portfolio_link = get_sub_field('portfolio_item_link');
                                                    echo esc_url($portfolio_link); ?>">
                                                        <img src="<?php $portfolio_image = get_sub_field('portfolio_item_image');
                                                        echo esc_url($portfolio_image['url']); ?>"
                                                             alt="<?php echo esc_attr($portfolio_image['alt']); ?>">
                                                        <h4>
                                                            <?php $portfolio_item_title = get_sub_field('portfolio_item_title');
                                                            echo esc_html($portfolio_item_title); ?>
                                                        </h4>
                                                        <?php $portfolio_item_excerpt = get_sub_field('portfolio_item_excerpt');
                                                        echo $portfolio_item_excerpt; ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div><!-- .swiper-wrapper -->
                            </div><!-- .swiper-container -->
                            <div class="view_more">
                                <?php
                                $portfolio_link = get_field('portfolio_link');
                                ?>
                                <?php if ($portfolio_link) {
                                    ?>
                                    <a href="<?php echo esc_url($portfolio_link['url']); ?>"><?php echo esc_html($portfolio_link['title']); ?></a>
                                    <?php
                                } ?>
                            </div><!-- .view_more -->
                        </div><!-- .portfolio__wrapper -->
                    </div><!-- .col-24 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </section><!-- .portfolio -->
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('portfolio', 'portfolio_shortcode');

    function order_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="order">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 col-md-10">
                        <div class="title">
                            <?php if (get_field('order_title_fa')) { ?>
                                <h4><?php the_field('order_title_fa'); ?></h4>
                            <?php } ?>

                            <?php if (get_field('order_title_en')) { ?>
                                <p><?php the_field('order_title_en'); ?></p>
                            <?php } ?>
                        </div><!-- .title -->
                            <div class="order__contact">
                                <?php
                                $order_contact_text = get_field( 'order_contact_text' );
                                if ( $order_contact_text ){
                                ?>
                                <div class="contact_text">
                                   <?php echo esc_html( $order_contact_text ); ?>
                                </div>
                                <?php } ?>
                                <?php
                                $order_contact_btn = get_field( 'order_contact_btn' );
                                $order_btn_title = $order_contact_btn['title'];
                                $order_btn_url = $order_contact_btn['url'];
                                ?>
                                <div class="contact_info">
                                    <?php if ( $order_contact_btn ){
                                        ?>
                                        <div class="contact_button">
                                            <a href="<?php echo esc_url( $order_btn_url ); ?>">
                                                <?php echo esc_html( $order_btn_title ); ?>
                                            </a>
                                        </div>
                                <?php
                                    } ?>
                                    <?php $order_tel = get_field( 'order_contact_tel' );
                                    if ( $order_tel ){
                                        ?>
                                        <div class="contact_tel"> <?php echo esc_html( $order_tel ); ?> </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div><!-- .order__contact -->
                    </div><!-- .col-xl-10 -->
                    <div class="col-xl-14 col-md-14">
                        <div class="order__content">
                            <ul class="simplebar">
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
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('order', 'order_shortcode');

    function videos_shortcode()
    {
        ob_start();
        ?>
        </div><!-- .container -->
        <section class="videos">
            <div class="container">
                <div class="row">
                    <div class="col-xl-24">
                        <div class="videos__wrapper">
                            <div class="swiper-container">
                                <div class="title">
                                    <?php if (get_field('videos_title_fa')) { ?>
                                        <h4><?php the_field('videos_title_fa'); ?></h4>
                                    <?php } ?>

                                    <?php if (get_field('videos_title_en')) { ?>
                                        <p><?php the_field('videos_title_en'); ?></p>
                                    <?php } ?>

                                </div><!-- .title -->
                                <div class="swiper-pagination"></div>
                                <div class="swiper-wrapper">
                                    <?php
                                    if (have_rows('videos')) {
                                        while (have_rows('videos')) {
                                            the_row();
                                            $item_img = get_sub_field('item_img');
                                            $medium_size = $item_img['sizes']['medium'];
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <div class="item__video_image_wrapper">
                                                        <a class="video_link" target="_blank"
                                                           href="<?php echo esc_url(get_sub_field('item_link')); ?>"><span
                                                                    class="icon-play"></span>
                                                        </a>
                                                        <?php
                                                        if (!empty($item_img)) {
                                                            ?>
                                                            <img src="<?php echo esc_url( $medium_size ); ?>"
                                                                 alt="<?php echo esc_attr($item_img['alt']); ?>">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div><!-- .video_image_wrapper -->
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
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('videos', 'videos_shortcode');

    function blog_shortcode($atts)
    {
        ob_start();
        $attributes = shortcode_atts(
            array(
                'post_ids' => ''
            ),
            $atts
        );
        $post_ids = StrToArr($attributes['post_ids'], ',');
        $args = [
            'post__in' => $post_ids,
            'ignore_sticky_posts' => true
        ];
        $blog_posts = new WP_Query($args);
        ?>
        </div><!-- .container -->
        <section class="blog">
            <div class="container">
                <div class="blog__wrapper">
                    <div class="swiper-container">
                        <div class="title">

                            <?php if (get_field('blog_title_fa')) { ?>
                                <h4><?php the_field('blog_title_fa'); ?></h4>
                            <?php } ?>

                            <?php if (get_field('blog_title_en')) { ?>
                                <p><?php the_field('blog_title_en'); ?></p>
                            <?php } ?>

                        </div><!-- .title -->
                        <div class="swiper-pagination"></div>
                        <div class="swiper-wrapper">
                            <?php
                            if ($blog_posts->have_posts()) {
                                while ($blog_posts->have_posts()) {
                                    $blog_posts->the_post();
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="post_wrapper">
                                            <div class="post_img_wrapper">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
                                                </a>
                                            </div><!-- .post_img_wrapper -->
                                            <a class="post_title"
                                               href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <!-- .post_title -->
                                            <!-- <h4></h4> -->
                                            <p class="post_excerpt">
                                                <?php echo get_the_excerpt(); ?>
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
        <div class="container">
        <?php
        return ob_get_clean();
    }

    add_shortcode('blog', 'blog_shortcode');
}

