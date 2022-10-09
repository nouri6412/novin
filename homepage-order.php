<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Negharenovin
 * @since 1.0.0
 * Template Name: صفحه فرود
 */

get_header('order');

?>

<main class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="title_site mb-2">
                    <h2>سلام خوش اومدی !</h2>
                </div>
                <p class="text-center mb-5">چی می خوای سفارش بدی ؟</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio card-order">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/images/img1031.jpg" alt="Card image cap">
                    <div class="card-body p-4">
                        <h3 class="text-center">تابلو فرش</h3>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio  card-order">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/images/img100.jpg" alt="Card image cap">
                    <div class="card-body p-4">
                        <h3 class="text-center">تابلو فرش</h3>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio  card-order">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/images/img100.jpg" alt="Card image cap">
                    <div class="card-body p-4">
                        <h3 class="text-center">تابلو فرش</h3>
                    </div>
                </a>
            </div>

        </div>
    </div>
</main>

<?php get_footer('order') ?>