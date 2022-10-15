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

<?php
add_filter('acf/load_field/name=start-date', function ($field) {
    $field['default_value'] = date('Y-m-d');
    return $field;
});
add_filter('acf/load_field/name=to-date', function ($field) {
    $field['default_value'] = date('Y-m-d');
    return $field;
});

add_action('acf/init', 'master_leave_form_init');
function master_leave_form_init() {

    // Check function exists.
    if( function_exists('acf_register_form') ) {

        // Register form.
        acf_register_form(array(
            'id'       => 'novin-product-order',
            'post_id'  => 'new_post',
            'new_post' => array(
                'post_type'   => 'novin-product-order',
                'post_status' => 'publish',
                'post_title' => 'test'
            ),
            //'post_title'  => true,
            'field_groups' => [54],
            'fields' => array('test','plan'),
            'submit_value' => 'ثبت سفارش',
            'updated_message' => '<h2>order complete</h2>',
        ));
    }
}

add_shortcode( 'novin_product_order', 'fun_novin_product_order' );
function fun_novin_product_order( $atts ) {
    
     acf_form_head(); ?>

    <div id="primary" class="content-area">
        <div id="content">
            <?php acf_form('novin-product-order'); ?>
        </div><!-- #content -->
    </div><!-- #primary -->

    <?php
}
