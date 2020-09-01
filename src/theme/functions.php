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
function web_design_sec_shortcode( $atts )
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
function your_position_shortcode( $atts ){
ob_start(); ?>
    <section class="your_position">
        <div class="outer_text_wrapper">
            <div class="container">
                <div class="text">
                    <div class="title">
                        <h4><span>موقعیت</span> شما</h4>
                        <p>Your position</p>
                    </div><!-- .title -->
                    <p>اما این تنها شروع ماجراست و زمانی که تصمیم می‌گیرید طراحی سایت خود را به یک گروه بسپارید، تازه آن
                        موقع است که متوجه خواهید شد چه انتخاب دشواری پیش رویتان است. صدها نام مختلف در این حوزه وجود دارد که
                        همگی ادعا می‌کنند از بهترین طراحان کشور در تیم خود بهره می‌برند و بالاترین کیفیت را به شما ارائه
                        خواهند داد. اما زمانی که سه فیلتر رضایت مشتریان، به‌کارگیری استانداردهای روز جهان و سابقه‌ی درخشان را
                        بر روی گزینه‌های خود اعمال کنید، اینجاست که تنها نام‌های درخشانی همچون تیم طراحی آی وحید در صحنه باقی
                        می‌مانند.</p>
                </div><!-- .text -->
            </div><!-- .container -->
        </div><!-- .outer_text_wrapper -->
        <div class="your_position__content_wrapper">
            <img class="background" src="http://127.0.0.1:3020/wp-content/uploads/2020/09/your_position_back_2.png" alt="your position background">
            <div class="your_position__container">
                <div class="col-lg-21">
                    <div class="inner_text_wrapper">
                        <div class="text">
                            <div class="title">
                                <h4><span>موقعیت</span> شما</h4>
                                <p>Your position</p>
                            </div><!-- .title -->
                            <p>اما این تنها شروع ماجراست و زمانی که تصمیم می‌گیرید طراحی سایت خود را به یک گروه بسپارید، تازه آن
                                موقع است که متوجه خواهید شد چه انتخاب دشواری پیش رویتان است. صدها نام مختلف در این حوزه وجود دارد که
                                همگی ادعا می‌کنند از بهترین طراحان کشور در تیم خود بهره می‌برند و بالاترین کیفیت را به شما ارائه
                                خواهند داد. اما زمانی که سه فیلتر رضایت مشتریان، به‌کارگیری استانداردهای روز جهان و سابقه‌ی درخشان را
                                بر روی گزینه‌های خود اعمال کنید، اینجاست که تنها نام‌های درخشانی همچون تیم طراحی آی وحید در صحنه باقی
                                می‌مانند.</p>
                        </div><!-- .text -->
                    </div><!-- .inner_text_wrapper -->
                </div><!-- .col-lg-21 -->
                <div class="swiper-container categories_title_list">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>برند</span>
                                <div>01</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>استراتژی</span>
                                <div>02</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>تحلیل</span>
                                <div>03</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>نیاز ها</span>
                                <div>04</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>طراحی سایت</span>
                                <div>05</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>محتوا سازی</span>
                                <div>06</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>برندینگ</span>
                                <div>07</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>اپلیکیشن</span>
                                <div>08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_info">
                                <span>تبلیغات</span>
                                <div>09</div>
                            </div>
                        </div>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .categories_title_list -->
                <div class="swiper-container categories_description_list">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>01</span>
                                <h4>برند</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>02</span>
                                <h4>استراتژی</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>03</span>
                                <h4>تحلیل</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>04</span>
                                <h4>نیاز ها</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>05</span>
                                <h4>طراحی سایت</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>06</span>
                                <h4>محتواسازی</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>07</span>
                                <h4>برندینگ</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>08</span>
                                <h4>اپلیکیشن</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide_content">
                                <span>09</span>
                                <h4>تبلیغات</h4>
                                <p>در زندگی دیجیتالی امروز داشتن وب سایت برای یک کسب و کار یکی از الزامات می باشد. تفاوتی نمی کند
                                    که شما یک کسب و کار بزرگ یا کوچک هستید، اگر شما یک کسب و کاری دارید که برای آن وب سایتی تهیه
                                    نکرده اید قطعا فرصت های زیادی را در کسب وکار خود از دست داده اید. </p>
                            </div>
                        </div>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .categories_description_list -->
            </div><!-- .your_position_wrapper -->
        </div><!-- .image_container -->
    </section><!-- .your_position -->
    <?php
    return ob_get_clean();
}

add_shortcode( 'your_position' , 'your_position_shortcode' );














