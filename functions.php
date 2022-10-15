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

add_action('acf/input/admin_print_footer_scripts', 'acfe_form_fix_uploaded_to');
function acfe_form_fix_uploaded_to(){
    ?>
    <script>
    (function($){

        if(typeof acf === 'undefined' || typeof acfe === 'undefined'){
            return;
        }
        
        acf.addAction('prepare', function(){
    
            // reset id back to ACF default to allow "uploaded to" setting to work correctly
            if(!acfe.get('is_admin') && acf.isset(window, 'wp', 'media', 'view', 'settings', 'post')){
                wp.media.view.settings.post = {};
                wp.media.view.settings.post.id = 0;
            }
    
        }, 15);
        
    })(jQuery);
    </script>
    <?php
}