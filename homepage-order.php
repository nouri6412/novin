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

$cat_selected = "";
$step = 1;
if (isset($_GET["cat_selected"])) {
    $cat_selected = $_GET["cat_selected"];
    $step = 2;
}

?>

<main class="content">
    <?php if ($step == 1) { ?>
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
                        <a href="<?php echo site_url("?cat_selected=" . $item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                            <div class="card-body">
                                <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else if ($step == 2) {
        $cat = [];
        $boxs = get_field("boxs");
        foreach ($boxs as $box) {
            $item = $box['box'];
            if ($item["link"] == $cat_selected) {
                $cat = $box['box'];
            }
        }
    ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">

                    <div class="title_site mb-2">
                        <h2><?php echo 'انتخاب شما' . ' ' . $cat["title"] . ' ' . 'است'; ?></h2>
                    </div>
                    <p class="text-center mb-5 text-logo"><?php echo 'خب سایز' . ' ' . $cat["title"] . ' ' . 'رو انتخاب کن!'; ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <?php
                $sizes = $cat["sizes"];
                foreach ($sizes as $size) {
                    $item = $size["product"];
                    $image = "";
              
                    if (has_post_thumbnail($item)) {
                        $image = get_the_post_thumbnail_url($item);
                    } else {
                        $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                    }
                ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="<?php echo get_permalink($item) ?>" class="card card-style card-portfolio card-order card-yellow">
                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $image; ?>" alt="<?php echo get_the_title($item); ?>">
                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                            <div class="card-body">
                                <h3 class="text-center"><?php echo get_the_title($item); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="container" style="display: none">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <?php
                                $boxs = get_field("boxs");
                                foreach ($boxs as $box) {
                                    $item = $box['box'];
                                ?>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <a href="<?php echo site_url("?cat_selected=" . $item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                                            <div class="card-body">
                                                <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="row">

                                <?php
                                $boxs = get_field("boxs");
                                foreach ($boxs as $box) {
                                    $item = $box['box'];
                                ?>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <a href="<?php echo site_url("?cat_selected=" . $item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                                            <div class="card-body">
                                                <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="row">

                                <?php
                                $boxs = get_field("boxs");
                                foreach ($boxs as $box) {
                                    $item = $box['box'];
                                ?>
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <a href="<?php echo site_url("?cat_selected=" . $item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                                            <div class="card-body">
                                                <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <form id="myform" class="form" method="post" action="" enctype="multipart/form-data">
                <input type="file" name="myfilefield" class="form-control" value="">
                <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    <?php  } ?>
</main>

<?php get_footer('order') ?>