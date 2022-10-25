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
$size_selected = 0;
$plan_selected = 0;
$step = 1;
if (isset($_GET["cat_selected"])) {
    $cat_selected = $_GET["cat_selected"];
    $step = 2;
}
if (isset($_GET["size_selected"])) {
    $size_selected = $_GET["size_selected"];
    $step = 3;
}

if (isset($_GET["plan_selected"])) {
    $plan_selected = $_GET["plan_selected"];
    $step = 4;
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
                        $image = get_the_post_thumbnail_url($item, '');
                    } else {
                        $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                    }
                    $product = wc_get_product($item);
                ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="<?php echo site_url("?size_selected=" . $item . '&cat_selected=' . $cat_selected) ?>" class="card card-style card-portfolio card-order card-yellow">
                            <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $image; ?>" alt="<?php echo get_the_title($item); ?>">
                            <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                            <div class="card-body">
                                <h3 class="text-center"><?php echo get_the_title($item); ?></h3>
                                <h3 class="text-center"><?php echo  $product->get_price_html(); ?></h3>

                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php  } else if ($step == 3) {
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
                        <h2><?php echo 'انتخاب طرح'; ?></h2>
                    </div>
                    <p class="text-center mb-5 text-logo"><?php echo ' طرح خود را بارگذاری و یا از طرح های آماده انتخاب کنید'; ?></p>
                </div>
            </div>
        </div>
        <form data-target="file" data-type="img" id="myform" class="form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" id="plan-uploaded" name="plan-uploaded" value="0">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 mb-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 mb-4">
                                <input style="display: none;" type="file" name="myfilefield" id="myfilefield" class="form-control" value="">
                                <a href="#" onclick="$('#myfilefield').click()" class="btn btn-primary">انتخاب طرح خودم</a>
                                <button type="submit" class="btn btn-success">بارگذاری طرح</button>
                                <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 mb-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    انتخاب از طرح های آماده
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">طرح های آماده</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <?php
                                                    $plans = $cat["plans"];
                                                    foreach ($plans as $plan) {
                                                        $item = $plan['plan'];
                                                    ?>
                                                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                                                            <a data-bs-dismiss="modal" onclick="select_plan_from_gallery($(this))" href="#" class="card card-style card-portfolio card-order card-yellow">
                                                                <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item; ?>">
                                                                <div class="card-body">
                                                                    <h3 class="text-center"><?php echo ''; ?></h3>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-sm-4 col-md-4 mb-4">
                        <button onclick="selected_plan_to_next($(this))" data-href="<?php echo site_url("?size_selected=" . $size_selected . '&cat_selected=' . $cat_selected) ?>" type="button" class="btn btn-success mb-1 w-100">برو به مرحله بعدی </button>

                        <img style="max-height: 285px;" data-state="0" id="plan-uploaded-img" class="card-img-top img-fluid file" src="<?php echo get_template_directory_uri() . "/assets/img/NoImage.jpg"; ?>">

                        <div class="spinner-border" style="display:none ;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php
    } else if ($step == 4) {
        $cat = [];
        $boxs = get_field("boxs");
        foreach ($boxs as $box) {
            $item = $box['box'];
            if ($item["link"] == $cat_selected) {
                $cat = $box['box'];
            }
        } ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">

                    <div class="title_site mb-2">
                        <h2><?php echo 'متعلقات و درخواست های بیشتر'; ?></h2>
                    </div>
                    <p class="text-center mb-5 text-logo"><?php echo 'هر کدام از موارد زیر را با در نظر گرفتن هزینه اضافه به سفارشتان اضافه نمائید '; ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <?php
                        $options = $cat["options"];
                        foreach ($options as $option) {
                            $item = $option['option'];
                            $product = wc_get_product($item["product"]);
                        ?>
                            <?php if ($item["is_checkbox"] == 1) { ?>
                                <div class="col-12 col-sm-6 col-md-4 mb-4"><input name="option-<?php echo $item["product"]; ?>" id="option-<?php echo $item["product"]; ?>" value="<?php echo $item["product"]; ?>" type="checkbox" />
                                    <label><?php echo $item["title"] . ' - ' . $product->get_price_html() ?></label>
                                </div>
                            <?php  } else { ?>
                                <div class="col-12 col-sm-6 col-md-4 mb-4">
                                    <div class="row">

                                        <label class="col-12"><?php echo $item["title"] . ' - ' . $product->get_price_html() ?></label>
                                        <textarea class="col-12" name="option-<?php echo $item["product"]; ?>" id="option-<?php echo $item["product"]; ?>"></textarea>
                                    </div>
                                </div>
                            <?php  } ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-12">
                    <form data-target="file" data-type="href" id="myform" class="form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" id="plan-uploaded" name="plan-uploaded" value="0">
                        <input style="display: none;" type="file" name="myfilefield" id="myfilefield" class="form-control" value="">
                        <a href="#" onclick="$('#myfilefield').click()" class="btn btn-primary">انتخاب فرکانس صدا</a>
                        <button type="submit" class="btn btn-success">بارگذاری فایل صدا</button>
                        <?php    $product = wc_get_product($cat["ferecans_seda"]); ?>
                        <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>
                        <label class=""><?php echo $product->get_price_html() ?></label>
                        <a id="file-voice" class="file" href="#" target="_blank"></a>
                    </form>
                </div>
                <?php if (isset($cat["has_ghab"]) && $cat["has_ghab"] == 1) { ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mt-5">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            انتخاب قاب از گالری
                        </button>
                        <input id="ghab-uploaded-img-value" value="0" type="hidden" />
                        <img style="max-height: 285px;" data-state="0" id="ghab-uploaded-img" class="card-img-top img-fluid mt-2" src="<?php echo get_template_directory_uri() . "/assets/img/NoImage.jpg"; ?>">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">انتخاب قاب</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                            <?php
                                            $ghabs = $cat["ghabs"];
                                            foreach ($ghabs as $ghab) {
                                                $item = $ghab['ghab'];
                                                $image = "";

                                                if (has_post_thumbnail($item)) {
                                                    $image = get_the_post_thumbnail_url($item, '');
                                                } else {
                                                    $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                                                }
                                                $product = wc_get_product($item);
                                            ?>
                                                <div class="col-12 col-sm-6 col-md-4 mb-4">
                                                    <a data-bs-dismiss="modal" data-product-id="<?php echo $item ?>" onclick="select_ghab_from_gallery($(this))" href="#" class="card card-style card-portfolio card-order card-yellow">
                                                        <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $image; ?>" alt="<?php echo get_the_title($item); ?>">

                                                        <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                                                        <div class="card-body">
                                                            <h3 class="text-center"><?php echo get_the_title($item); ?></h3>
                                                            <h3 class="text-center"><?php echo $product->get_price_html(); ?></h3>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>

            </div>
        </div>
    <?php } ?>
</main>

<?php get_footer('order') ?>