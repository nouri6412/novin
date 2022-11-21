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
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url() ?>"><i class="fa fa-home"></i><?php echo ' '.'خانه'; ?></a>
                        <a class="nav-link "  href="<?php echo site_url('cart') ?>"><i class="fa fa-shopping-cart"></i><?php echo ' '.'سبد خرید'; ?></a>
                        <a class="nav-link "  href="<?php echo site_url('about-us') ?>"><i class="fa fa-info-circle"></i><?php echo ' '.' در باره ما'; ?></a>

                   
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