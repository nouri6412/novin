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

$cat_selected="";
if(isset($_GET["cat_selected"]))
{
    $cat_selected=$_GET["cat_selected"];
}

?>

<main class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="title_site mb-2">
                    <h2><?php echo get_field("title"); ?></h2>
                </div>
                <p class="text-center mb-5 text-logo"><?php echo get_field("desc"); ?></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <?php
            $boxs = get_field("boxs");
            foreach ($boxs as $box) {
                $item = $box['box'];
            ?>
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <a href="<?php echo site_url("?cat_selected=".$item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                        <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                        <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                        <div class="card-body">
                            <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
        <?php echo do_shortcode( '[novin_product_order]'); ?>
    </div>
</main>

<?php get_footer('order') ?>


