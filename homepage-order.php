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
                <p class="text-center mb-5 text-logo">چی می خوای سفارش بدی ؟</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio card-order card-yellow">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt="Card image cap">
                   <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-yellow-2.png" /></div>
                    <div class="card-body p-4">
                        <h3 class="text-center text-logo">تابلو فرش</h3>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio  card-order card-yellow">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt="Card image cap">
                    <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-yellow-2.png" /></div>

                    <div class="card-body p-4">
                        <h3 class="text-center text-logo"> دار قالی</h3>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <a href="#" class="card card-style card-portfolio  card-order card-yellow">
                    <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt="Card image cap">
                    <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-yellow-2.png" /></div>

                    <div class="card-body p-4">
                        <h3 class="text-center text-logo"> سوپرایز باکس</h3>
                    </div>
                </a>
            </div>

        </div>
    </div>
</main>

<?php get_footer('order') ?>