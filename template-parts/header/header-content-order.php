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
                    <div class="header_add-t-cart">

                        <!-- <button type="button" class="close close_addtocart " data-dismiss="area_add-t-cart"
                                        aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <button type="button" class="btn-close close_addtocart" aria-label="Close"></button>

                        <h4 class="title_add-t-cart text-center" id="myModalLabel"><a href="#">مشاهده سبد
                                خرید</a></h4>
                    </div>
                    <div class="body_add-t-cart p-4">
                        <div class="row mb-4">
                            <div class="col-3 order-1">
                                <div class="img_product_addtocart h-100 d-flex align-items-center">
                                    <a href="#"><img class="img-fluid mt-3" src="images/saat.jpg" /></a>
                                </div>
                            </div>
                            <div class="col-7 order-2">
                                <div class="details_product_addtocart">
                                    <div class="title_product_addtocart mb-1"><a href="#">ساعت مچی</a>
                                    </div>
                                    <div class="details_price_addtocart d-flex align-items-center">
                                        <input name="input" type="number" value="1" class="ms-2">
                                        <div class="price_product_addtocart d-flex">
                                            <span class="order-2"> 20000 تومان</span>
                                            <span class="order-1 ms-2">x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2  d-flex align-items-center justify-content-center order-3">
                                <div class="close_product_addtocart"> <a href="#" class="d-flex p-1"><i class="far fa-times-circle"></i><span class="tooltip-site">حذف</span></a></div>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-3 order-1">
                                <div class="img_product_addtocart h-100"><a href="#"><img class="img-fluid mt-3" src="images/shoes21.jpg" /></a>
                                </div>
                            </div>
                            <div class="col-7 order-2">
                                <div class="details_product_addtocart">
                                    <div class="title_product_addtocart mb-1"><a href="#">کفش
                                            اسپرت</a>
                                    </div>
                                    <div class="details_price_addtocart d-flex align-items-center">
                                        <input name="input" type="number" value="1" class="ms-2">
                                        <div class="price_product_addtocart d-flex">
                                            <span class="order-2"> 20000 تومان</span>
                                            <span class="order-1 ms-2">x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-center order-3">
                                <div class="close_product_addtocart"> <a href="#" class="d-flex p-1"><i class="far fa-times-circle"></i><span class="tooltip-site">حذف</span></a></div>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-3 order-1">
                                <div class="img_product_addtocart h-100"><a href="#"><img class="img-fluid mt-3" src="images/hedfon32.jpg" /></a>
                                </div>
                            </div>
                            <div class="col-7 order-2">
                                <div class="details_product_addtocart">
                                    <div class="title_product_addtocart mb-1"><a href="#">هدفون
                                            سونی</a>
                                    </div>
                                    <div class="details_price_addtocart d-flex align-items-center">
                                        <input name="input" type="number" value="1" class="ms-2">
                                        <div class="price_product_addtocart d-flex">
                                            <span class="order-2"> 20000 تومان</span>
                                            <span class="order-1 ms-2">x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-center order-3">
                                <div class="close_product_addtocart"> <a href="#" class="d-flex p-1"><i class="far fa-times-circle"></i><span class="tooltip-site">حذف</span></a></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-3 order-1">
                                <div class="img_product_addtocart h-100 d-flex align-items-center">
                                    <a href="#"><img class="img-fluid mt-3" src="images/saat.jpg" /></a>
                                </div>
                            </div>
                            <div class="col-7 order-2">
                                <div class="details_product_addtocart">
                                    <div class="title_product_addtocart mb-1"><a href="#">ساعت
                                            مچی</a>
                                    </div>
                                    <div class="details_price_addtocart d-flex align-items-center">
                                        <input name="input" type="number" value="1" class="ms-2">
                                        <div class="price_product_addtocart d-flex">
                                            <span class="order-2"> 20000 تومان</span>
                                            <span class="order-1 ms-2">x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2  d-flex align-items-center justify-content-center order-3">
                                <div class="close_product_addtocart"> <a href="#" class="d-flex p-1"><i class="far fa-times-circle"></i><span class="tooltip-site">حذف</span></a></div>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-3 order-1">
                                <div class="img_product_addtocart h-100"><a href="#"><img class="img-fluid mt-3" src="images/shoes21.jpg" /></a>
                                </div>
                            </div>
                            <div class="col-7 order-2">
                                <div class="details_product_addtocart">
                                    <div class="title_product_addtocart mb-1"><a href="#">کفش
                                            اسپرت</a>
                                    </div>
                                    <div class="details_price_addtocart d-flex align-items-center">
                                        <input name="input" type="number" value="1" class="ms-2">
                                        <div class="price_product_addtocart d-flex">
                                            <span class="order-2"> 20000 تومان</span>
                                            <span class="order-1 ms-2">x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-center order-3">
                                <div class="close_product_addtocart"> <a href="#" class="d-flex p-1"><i class="far fa-times-circle"></i><span class="tooltip-site">حذف</span></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_addtocart  p-4">
                        <div class="area_total_modal_addtocart mb-4  d-flex justify-content-between">
                            <span>مجموع :</span>
                            <span> تومان3250000</span>
                        </div>
                        <a href="#" class="btn btn-custom  btn-block btn_add-t-cart"> تسویه
                            حساب <i class="fal fa-credit-card me-1"></i>
                        </a>

                    </div>
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