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
$Main_post_id = get_the_ID();
$cat_selected = "";
$size_selected = 0;
$plan_selected = 0;
$plan_selected_type = 0;
$category_size = 0;
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

if (isset($_GET["plan_selected_type"])) {
    $plan_selected_type = $_GET["plan_selected_type"];
}

if (isset($_GET["category_size"])) {
    $category_size = $_GET["category_size"];
}

?>
<main class="content <?php if ($step == 1) echo 'bg-ex'; ?>">
    <input type="hidden" id="order-home-step" name="order-home-step" value="<?php echo $step ?>" />
    <?php if ($step > 1) { ?>
        <div class="container mt-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
                    <?php if ($step > 1) { ?>
                        <li class="breadcrumb-item" <?php if ($step == 2) echo 'aria-current="page"' ?>>انتخاب سایز</li>
                    <?php } ?>
                    <?php if ($step > 2) { ?>
                        <li class="breadcrumb-item" <?php if ($step == 3) echo 'aria-current="page"' ?>>انتخاب طرح</li>
                    <?php } ?>
                    <?php if ($step > 3) { ?>
                        <li class="breadcrumb-item" <?php if ($step == 4) echo 'aria-current="page"' ?>>آپشن های طراحی</li>
                    <?php } ?>
                    <li style="display: none;" class="breadcrumb-item breadcrumb-item-step5">انتخاب قاب</li>
                </ol>
            </nav>
        </div>
    <?php } ?>
    <?php if ($step == 1) { ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="title_site mb-2">
                        <h2><?php echo get_field("title"); ?></h2>
                    </div>
                    <p class="text-center mb-2 text-logo"><?php echo get_field("desc"); ?></p>
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
                        <div class="box-padd">
                            <a href="<?php echo site_url("?cat_selected=" . $item["link"]) ?>" class="card card-style card-portfolio card-order card-yellow">
                                <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>">
                                <div class="bg-yellow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg-black-2.png" /></div>
                                <div class="card-body">
                                    <h3 class="text-center"><?php echo $item["title"]; ?></h3>
                                </div>
                            </a>
                        </div>
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
                        <h3><?php echo 'انتخاب شما' . ' ' . $cat["title"] . ' ' . 'است'; ?></h3>
                    </div>
                    <p class="text-center mb-1 text-logo"><?php echo 'خب سایز' . ' ' . $cat["title"] . ' ' . 'رو انتخاب کن!'; ?></p>

                    <h4>دسته بندی سایز ها</h4>
                    <div class="m-2">
                        <a class="btn btn-outline-primary" href="<?php echo site_url("?cat_selected=" . $cat_selected) ?>">همه سایز ها</a>

                        <?php
                        $cat_sizes = $cat["size-cats"];

                        foreach ($cat_sizes as $cat_item) {
                        ?>
                            <a class="btn btn-outline-primary" href="<?php echo site_url("?cat_selected=" . $cat_selected . "&category_size=" . $cat_item->term_id) ?>"><?php echo $cat_item->name ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="bg-tag">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/tag.png" />
            </div>
            <div class="row box-black">

                <?php
                $sizes = $cat["sizes"];
                foreach ($sizes as $size) {
                    $item = $size["product"];
                    $image = "";
                    if ($category_size > 0) {
                        $terms = get_the_terms($item, 'product_cat');
                        $flag = false;
                        foreach ($terms as $term) {
                            if ($term->term_id == $category_size) {
                                $flag = true;
                                break;
                            }
                        }
                        if ($flag == false) {
                            continue;
                        }
                    }
                    if (has_post_thumbnail($item)) {
                        $image = get_the_post_thumbnail_url($item, '');
                    } else {
                        $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                    }
                    $product = wc_get_product($item);
                ?>
                    <div class="col-6 col-sm-6 col-md-3 col-box">
                        <div onclick="change_img_box_plan($(this))" data-img="<?php echo $image; ?>" data-href="<?php echo site_url("?size_selected=" . $item . '&cat_selected=' . $cat_selected) ?>" class="card card-portfolio  card-yellow">
                            <div class="bg-yellow-fix"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/box-1.png" /></div>
                            <!-- <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $image; ?>" alt="<?php echo get_the_title($item); ?>"> -->
                            <div class="card-body card-body-fix">
                                <h3 class="text-center text-black box-h-4"><?php echo get_the_title($item); ?></h3>
                                <h3 class="text-center text-black box-h-3"><?php echo  $product->get_price_html(); ?></h3>

                            </div>
                        </div>
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
                    <p id="paragraph-plan" class="text-center mb-5 text-logo"><?php echo ' طرح خود را بارگذاری و یا از طرح های آماده انتخاب کنید'; ?></p>
                </div>
            </div>
        </div>
        <form data-target="file" data-type="img" id="myform" class="form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" id="plan-uploaded" name="plan-uploaded" value="0">
            <div class="container">
                <div id="div-plan-select-option" class="row">
                    <div class="col-1 col-sm-3 col-md-3"></div>
                    <div class="col-10 col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div onclick="plan_select_option_personal()" class="row plan-select-option">
                                    <div class="col-8 col-sm-8 col-md-8 plan-select-option-item plan-select-option-right">
                                        <h3>طرح شخصی</h3>
                                    </div>
                                    <div style="background-image:url(<?php echo $cat["select-plan-personal"] ?>)" class="col-4 col-sm-4 col-md-4 plan-select-option-item plan-select-option-left">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <div onclick="plan_select_option_common()" class="row plan-select-option">
                                    <div class="col-8 col-sm-8 col-md-8 plan-select-option-item plan-select-option-right">
                                        <h3>طرح عمومی</h3>
                                    </div>
                                    <div style="background-image:url(<?php echo $cat["select-plan-common"] ?>)" class="col-4 col-sm-4 col-md-4 plan-select-option-item plan-select-option-left">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 col-sm-3 col-md-3"></div>
                </div>
                <div id="div-plan-select" style="display: none;" class="row">
                    <div class="col-12 col-sm-12 col-md-12 mb-4">
                        <div class="row">
                            <div id="div-plan-select-common" style="display:none ;" class="col-12 col-sm-8 col-md-8 mb-4">
                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    انتخاب از طرح های آماده
                                </button> -->
                                <h3 style="text-align: center;font-size: 24px;" class="mb-2">موضوعات طرح</h3>
                                <div class="m-2">
                                    <div class="row">
                                        <?php
                                        $cat_sizes = $cat["plan-subject"];

                                        foreach ($cat_sizes as $cat_item) {
                                            $image = get_field('img', $cat_item);
                                            if (strlen($image) == 0) {
                                                $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                                            }
                                        ?>
                                            <div onclick="select_redy_plan($(this))" data-id="redy-plan-<?php echo $cat_item->term_id; ?>" class="plan-subject col-6 col-sm-4 col-md-4 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <div class="plan-subject-title"><?php echo $cat_item->name ?></div>
                                                <div class="plan-subject-body"><img src="<?php echo $image ?>" /></div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
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
                                                        get_post($item);
                                                        $image = "";
                                                        if (has_post_thumbnail($item)) {
                                                            $image = get_the_post_thumbnail_url($item, '');
                                                        } else {
                                                            $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                                                        }

                                                        $terms = get_the_terms($item, 'category');
                                                        $class = "";
                                                        foreach ($terms as $term) {
                                                            $class .= " redy-plan-" . $term->term_id;
                                                        }
                                                    ?>
                                                        <div class="redy-plan col-12 col-sm-6 col-md-4 mb-4 <?php echo $class; ?>">
                                                            <a data-media-id="<?php echo $item; ?>" data-bs-dismiss="modal" onclick="select_plan_from_gallery($(this))" href="#" class="card card-style card-portfolio card-order card-yellow">
                                                                <img class="card-img-top img-fluid card-img-top-bradius" src="<?php echo $image; ?>">
                                                                <div class="card-body">
                                                                    <h3 class="text-center"><?php echo get_the_title($item); ?></h3>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                    get_post($Main_post_id);
                                                    ?>

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
                            <div class="col-12 col-sm-4 col-md-4 mb-4">
                                <!-- <button onclick="selected_plan_to_next($(this))" data-href="<?php echo site_url("?size_selected=" . $size_selected . '&cat_selected=' . $cat_selected) ?>" type="button" class="btn btn-success mb-1 w-100">برو به مرحله بعدی </button> -->
                                <div id="div-plan-select-personal" style="display:none ;" class="mb-4">
                                    <input style="display: none;" type="file" name="myfilefield" id="myfilefield" class="form-control" value="">
                                    <div onclick="$('#myfilefield').click()" class="btn btn-primary  col-12 mt-2">بارگذاری فایل </div>
                                    <!-- <button type="submit" class="btn btn-success mt-2">بارگذاری فایل</button> -->
                                    <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>
                                </div>
                                <img data-href="<?php echo site_url("?size_selected=" . $size_selected . '&cat_selected=' . $cat_selected) ?>" data-media-id="0" style="max-height: 285px;" data-state="0" id="plan-uploaded-img" class="card-img-top img-fluid file" src="<?php echo get_template_directory_uri() . "/assets/img/NoImage.jpg"; ?>">

                                <div class="spinner-border" style="display:none ;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
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
                        <h2 id="head-option-title"><?php echo 'آپشن های طراحی'; ?></h2>
                    </div>
                    <p id="head-option-p" class="text-center mb-5 text-logo"><?php echo 'هر کدام از موارد زیر را با در نظر گرفتن هزینه اضافه به سفارشتان اضافه نمائید '; ?></p>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-0 col-sm-3 col-md-3"></div>
                <h3 data-price="0" id="sum-price-option" class="col-12 col-sm-6 col-md-6 mb-3" style="color: green;font-size:18px;"></h3>
                <div class="col-0 col-sm-3 col-md-3"></div>

                <div class="col-0 col-sm-3 col-md-3"></div>
                <div id="select-ghab-panel-option" class="col-12 col-sm-6 col-md-6">
                    <div class="row select-option-extra">

                        <div class="col-12 col-sm-6 col-md-6 mb-4">
                            <?php $product = wc_get_product($cat["ferecans_seda"]); ?>
                            <label><?php echo 'فرکانس صدا' . ' - ' . $product->get_price_html() ?></label>
                            <select id="id-voice-value-select" onchange="change_select_option_extra($(this))" data-type="textarea" data-target="div-ferekans-seda" data-price="<?php echo $product->get_price() ?>">
                                <option value="0">نیاز نیست</option>
                                <option value="1">نیاز است</option>
                            </select>
                        </div>
                        <div style="display: none;" id="div-ferekans-seda" class="col-12 col-sm-6 col-md-6 mb-4">

                            <label><?php echo ' انتخاب فایل'  ?></label>

                            <form data-target="file" data-type="href" id="myform" class="form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" id="plan-uploaded" name="plan-uploaded" value="0">
                                <input style="display: none;" type="file" name="myfilefield" id="myfilefield" class="form-control" value="">

                                <a style="line-height: 1" href="#" onclick="$('#myfilefield').click()" class="btn btn-primary"><?php echo 'انتخاب فایل صدا' ?></a>
                                <!-- <button type="submit" class="btn btn-success mt-2">بارگذاری فایل صدا</button> -->
                                <a style="line-height: 1" class="btn btn-outline-primary" href="<?php echo $cat["ferecans_seda_help"] ?>" target="_blank">فایل راهنما</a>

                                <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>

                                <div class="spinner-border" style="display:none ;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <a data-media-id="0" style="color: red;display:block" id="file-voice" class="file" href="#" target="_blank"></a>
                                <input id="file-voice-value" type="hidden" value="0" />
                                <input id="id-voice-value" type="hidden" value="<?php echo $cat["ferecans_seda"]; ?>" />
                            </form>
                        </div>

                        <?php
                        $options = $cat["options"];
                        foreach ($options as $option) {
                            $item = $option['option'];
                            $product = wc_get_product($item["product"]);
                        ?>
                            <?php if ($item["is_checkbox"] == 1) { ?>
                                <div class="col-6 col-sm-6 col-md-6 mb-4">
                                    <label><?php echo $item["title"] . ' - ' . $product->get_price_html() ?></label>
                                    <select onchange="change_select_option_extra($(this))" data-type="select" data-id="<?php echo $item["product"]; ?>" name="f-option-<?php echo $item["product"]; ?>" id="f-option-<?php echo $item["product"]; ?>" data-price="<?php echo $product->get_price() ?>">
                                        <option value="0">نیاز نیست</option>
                                        <option value="1">نیاز است</option>
                                    </select>
                                    <!-- <input class="negarenovin-option" name="f-option-<?php echo $item["product"]; ?>" id="f-option-<?php echo $item["product"]; ?>" data-id="<?php echo $item["product"]; ?>" type="checkbox" /> -->

                                </div>
                            <?php  } else { ?>
                                <div class="col-6 col-sm-6 col-md-6 mb-4">
                                    <label><?php echo $item["title"] . ' - ' . $product->get_price_html() ?></label>
                                    <select onchange="change_select_option_extra($(this))" data-type="textarea" data-target="f-option-<?php echo $item["product"]; ?>" data-price="<?php echo $product->get_price() ?>" data-id="<?php echo $item["product"]; ?>" name="f-option-<?php echo $item["product"]; ?>" id="f-option-<?php echo $item["product"]; ?>">
                                        <option value="0">نیاز نیست</option>
                                        <option value="1">نیاز است</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <textarea style="display: none;width:100%" placeholder="متن خود را اینجا بنویسید" class="negarenovin-option" class="col-12" data-id="<?php echo $item["product"]; ?>" name="f-option-<?php echo $item["product"] . '-text'; ?>" id="f-option-<?php echo $item["product"] . '-text'; ?>"></textarea>
                                </div>
                            <?php  } ?>
                        <?php } ?>
                    </div>
                </div>
               


                <?php if (isset($cat["has_ghab"]) && $cat["has_ghab"] == 1) { ?>
               
                    <div style="display: none;" id="select-ghab-panel" class="col-12 col-sm-6 col-md-6 mb-4 mt-5">
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
                <div class="col-0 col-sm-3 col-md-3"></div>
                <div class="col-12">
                    <div class="col-12 col-sm-6 col-md-6 mb-5 mt-5">
                        <input id="f-plan-id" type="hidden" value="<?php echo $plan_selected ?>" />
                        <input id="f-plan-type" type="hidden" value="<?php echo $plan_selected_type ?>" />
                        <input id="f-size-id" type="hidden" value="<?php echo $size_selected ?>" />
                        <input id="f-site-url" type="hidden" value="<?php echo wc_get_cart_url() ?>" />
                        <div class="spinner-border" style="display:none ;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <!-- <button onclick="negarenovi_order_finish()" type="button" class="btn btn-success mb-1 w-100">تکمیل سفارش</button> -->
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
    <div class="m-5">
        <?php if ($step > 1) {
            $prev = "";
            $next = "0";
            if ($step == 2) {
                $prev = site_url();
            } else if ($step == 3) {
                $prev = site_url("?cat_selected=" . $cat_selected);
            } else if ($step == 4) {
                $prev = site_url("?cat_selected=" . $cat_selected . '&size_selected=' . $size_selected);
                $next = 1;
            }


        ?>
            <div style="display: none;" class="float-start"><a onclick="check_plan_selected($(this))" id="btn-next-step-cart" href="<?php echo wc_get_cart_url() ?>" class="btn btn-success">سبد خرید و پرداخت</a></div>
            <div class="float-start"><a onclick="check_plan_selected($(this))" id="btn-next-step" data-type="<?php echo $next ?>" href="#" class="btn btn-primary">مرحله بعدی</a></div>
            <div class="float-end"></div> <a onclick="fun_prev_step($(this))" id="btn-prev-step" href="<?php echo $prev; ?>" data-href="<?php echo $prev; ?>" class="btn btn-primary">مرحله قبلی</a>
        <?php } ?>
    </div>
</main>

<?php get_footer('order') ?>