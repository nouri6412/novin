<footer>
    <div class="area_footer_top">
        <div class="container">
            <div class="row">
                <?php
                $data = get_field("sec1", 'option');
                ?>
                <div class=" col-sm-6 col-lg-4">
                    <div class="widget_footer">
                        <div class="title_widget_footer">
                            <?php echo  $data["col-1-title"]; ?>
                        </div>
                        <div class="contenet_widget_footer">
                            <ul>
                                <?php
                                foreach ($data["col1"] as $col) {
                                    $group = $col["link"];
                                ?>
                                    <li><a href="<?php echo $group["link"] ?>"><?php echo $group["title"] ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4  mt-4 mt-sm-0">
                    <div class="widget_footer">
                        <div class="title_widget_footer"> <?php echo  $data["col-2-title"]; ?></div>
                        <div class="contenet_widget_footer">
                            <ul>
                                <?php
                                foreach ($data["col2"] as $col) {
                                    $group = $col;
                                ?>
                                    <li><span><?php echo $group["link"] ?></span>
                                    <?php
                                }
                                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 d-sm-flex d-md-flex flex-lg-column flex-row align-items-md-center align-items-lg-start">
                    <div class="widget_footer widget_footer_news pl-sm-3 pl-md-3 mt-4   mt-md-3 mt-lg-0 w-100">
                        <div class="title_widget_footer">?????????? ???? ??????????????</div>
                        <div class="contenet_widget_footer">
                            <form action="" method="post" class="form_news_footer">
                                <div class="input-group">
                                    <span><i class="far fa-envelope"></i></span>

                                    <button type="submit">??????????</button>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="?????????? ??????">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="display: flex;margin-top: 15px;" class="nemads">
                        <?php
                        $data = get_field("sec4", 'option');
                        ?>
                        <?php
                        foreach ($data as $col) {
                            $group = $col["group"];
                        ?>
                            <a title="<?php echo $group["title"] ?>" href="<?php echo $group["link"] ?>"><img style="width: 75px;margin:5px;" src="<?php echo $group["img"] ?>" /></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="area_footer_bottom">
        <div class="container">
            <div class="row area_element-multi">
                <?php
                $data = get_field("sec2", 'option');
                ?>
                <?php
                foreach ($data as $col) {
                    $group = $col["group"];
                ?>
                    <div class="col-6 col-md-4 col-xl-3 element-multi">
                        <div class="content-element-multi d-flex align-items-center  mb-3 ">
                            <div class="icon-element">
                                <i class="<?php echo $group["icon"] ?>"></i>
                            </div>
                            <div class="detail-element">
                                <h3><?php echo $group["title"] ?></h3>
                                <div class="text-multi-element"><?php echo $group["desc"] ?></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <hr class="hr_footer_bottom ">
            <div class="row pt-4 pb-4 pb-lg-5 align-items-center">
                <div class=" col-12 col-lg-8 col-xl-9">
                    <div class="area_menu_footer d-flex  align-items-md-center flex-column flex-md-row ">
                        <img src="<?php echo get_field("logo", 'option'); ?>" class="img-logoFooter ms-2 mb-2 d-none d-md-block" />
                        <?php
                        $data = get_field("sec3", 'option');
                        ?>
                        <div class="menu_footer mt-2 mt-md-0">
                            <ul>
                                <?php
                                foreach ($data["links"] as $col) {
                                    $group = $col["link"];
                                ?>
                                    <li><a href="<?php echo $group["link"] ?>"><?php echo $group["title"] ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-3 mt-4 mt-lg-0">
                    <div class="area-socialIcon d-flex justify-content-start justify-content-lg-end">
                        <?php
                        foreach ($data["icons"] as $col) {
                            $group = $col["link"];
                        ?>
                            <a href="<?php echo $group["link"] ?>" class="fa fa-<?php echo $group["icon"] ?>"><span class="tooltip-site"><?php echo $group["title"] ?></span></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between  pb-5 align-items-center">
                <div class="col-12 col-lg-4 mt-4 mt-lg-0  order-2 order-lg-1">
                    <div class="copyright">
                        <?php echo $data["right"] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="bg-white">
    <div class="box-plan">
        <img id="bg-white-box-plan-img" data-href="#" src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" />
        <button onclick="close_box_plan()" class="btn btn-close"><i class="fa fa-window-close"></i></button>
        <div style="height:40px ;" class="btn-operate mt-2 mb-2">
            <button onclick="change_img_box_plan_select()" class="float-start btn btn-outline-success btn-select"><?php echo '???????????? '; ?><i class="fa fa-check" aria-hidden="true"></i></button>
            <button onclick="close_box_plan()" class="float-start btn btn-outline-danger btn-cancel"><?php echo '???????????? '; ?><i class="fa fa-window-close" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<div id="social-share">
    <ul class="social-itens hidden">
        <?php
        $index = 0;
        foreach ($data["icons"] as $col) {
            $index++;
            if ($index > 4) {
                $index = 1;
            }
            $group = $col["link"];
        ?>
            <li>
                <button onclick="btn_share($(this))" data-href="<?php echo $group["link"] ?>" class="btn-share social-item-<?php echo $index ?>">
                    <i class="fa fa-<?php echo $group["icon"] ?>"></i>
                    <span class="btn-share-text">fa fa-<?php echo $group["title"] ?></span>
                </button>
            </li>
        <?php
        } ?>

    </ul>
    <div class="social-open-menu">
        <button class="btn-share"><i class="fa fa-phone"></i></button>
    </div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.5.0.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/popper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/carousel/owl.carousel.min.js"></script>
<!-- <script src="<?php echo get_template_directory_uri(); ?>/assets/js/all-js.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js?ver=1.0.12"></script>
</body>

</html>