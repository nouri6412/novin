<!-- <a class="scrollTo scroll-To-top " href=".topbar-site " style="visibility: visible; transform: translateY(0px);"></a> -->
<div class="bg-close">
</div>
<header>
    <div class="container topbar-site">
        <div class="row">
            <img class="col-12 topbar-site-banner" src="<?php echo get_field("option-header-banner-desctop", 'option'); ?>" />
            <img class="col-12 topbar-site-banner-phone" src="<?php echo get_field("option-header-banner-mobile", 'option'); ?>" />
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse show" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url() ?>"><i class="fa fa-home"></i><?php echo ' ' . 'خانه'; ?></a>
                        <a class="nav-link shooping-cat" href="#"><i class="fa fa-shopping-cart"></i><?php echo ' ' . 'سبد خرید'; ?></a>
                        <a class="nav-link " href="<?php echo site_url('about-us') ?>"><i class="fa fa-info-circle"></i><?php echo ' ' . ' درباره ما'; ?></a>


                    </div>
                </div>
                <!-- Modal -->
                <div class="area_add-t-cart">
                    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                        <div class="header_add-t-cart">

                            <!-- <button type="button" class="close close_addtocart " data-dismiss="area_add-t-cart"
                                        aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                            <button type="button" class="btn-close close_addtocart" aria-label="Close"></button>

                            <h4 class="title_add-t-cart text-center" id="myModalLabel"><a href="#"> سبد
                                    خرید</a></h4>
                        </div>
                        <div class="body_add-t-cart p-4">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                                    <div class="row mb-4">
                                        <div class="col-3 order-1">
                                            <div class="img_product_addtocart h-100 d-flex align-items-center">
                                                <?php
                                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('cart-thumb'), $cart_item, $cart_item_key);
                                                ?>
                                                <a href="#"><?php echo $thumbnail ?></a>
                                            </div>
                                        </div>
                                        <div class="col-7 order-2">
                                            <div class="details_product_addtocart">
                                                <div class="title_product_addtocart mb-1"><a href="#"><?php echo $_product->get_name() ?></a>
                                                </div>
                                                <div class="details_price_addtocart d-flex align-items-center">
                                                    <?php
                                                    // $product_quantity = woocommerce_quantity_input(
                                                    //     array(
                                                    //         'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    //         'input_type'   => "number",
                                                    //         'input_value'  => $cart_item['quantity'],
                                                    //         'max_value'    => $_product->get_max_purchase_quantity(),
                                                    //         'min_value'    => '0',
                                                    //         'product_name' => $_product->get_name()
                                                    //     ),
                                                    //     $_product,
                                                    //     false
                                                    // );
                                                    // echo $product_quantity;
                                                    echo '<input type="number" id="'.uniqid( 'quantity_' ).'" class="input-text qty text" step="1" min="1" max="" name="cart['.$cart_item_key.'][qty]" value="'.$cart_item['quantity'].'" title="تعداد" size="4" placeholder="" inputmode="numeric" autocomplete="off" style="width: 50px;margin-left: 5px;">';
                                                    ?>
                                                    <div class="price_product_addtocart d-flex">
                                                        <span class="order-2"><?php echo WC()->cart->get_product_price($_product) ?></span>
                                                        <span class="order-1 ms-2">x</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2  d-flex align-items-center justify-content-center order-3">
                                            <div class="close_product_addtocart">
                                                <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="d-flex p-1" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times-circle"></i><span class="tooltip-site">حذف</span></a>',
                                                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                        esc_html__('Remove this item', 'woocommerce'),
                                                        esc_attr($product_id),
                                                        esc_attr($_product->get_sku())
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="footer_addtocart  p-4">
                            <div class="area_total_modal_addtocart mb-4  d-flex justify-content-between">
                                <span>مجموع :</span>
                                <span> <?php wc_cart_totals_order_total_html(); ?></span>
                            </div>
                            <button type="submit" class="btn btn-custom  btn-block btn_add-t-cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">تسویه حساب</button>

                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <!-- <div class="container">
            <div class="row  d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <div class="tel_topbar-site  float-right ms-2">
                        <a href="<?php echo site_url(); ?>" class="md-1"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="لوگوی نگاره نوین"> </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="tel_topbar-site  float-start ms-2">
                        <i class="fal fa-phone-alt"></i>
                        <a href="tel:0914000000" class="me-1">091400000000</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</header>
<div class="container">
    <div class="top"></div>
</div>