<?php
/// ajax
function novin_theme_scripts()
{
    global $wp_query;

    wp_enqueue_script(
        'novin_ajax_script',
        get_template_directory_uri() . '/assets/js/ajax-v16.js',
        array('jquery'),
        1,
        false
    );

    wp_localize_script('novin_ajax_script', 'custom_theme_mbm_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => site_url(),
    ));
}

add_action('wp_enqueue_scripts', 'novin_theme_scripts');

function pn_upload_files()
{
    $result = ["upload_file" => 'true'];
    //Do the nonce security check
    if (!isset($_POST['mynonce']) || !wp_verify_nonce($_POST['mynonce'], 'myuploadnonce')) {
        //Send the security check failed message
        $result["error"] = 'Security Check Failed';
    } else {
        //Security check cleared, let's proceed
        //If your form has other fields, process them here.

        if (isset($_FILES) && !empty($_FILES)) {

            //Include the required files from backend
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            //Check if uploaded file doesn't contain any error
            if (isset($_FILES['myfilefield']['error']) && $_FILES['myfilefield']['error'] == 0) {
                /*
                 * 'myfilefield' is the name of the file upload field.
                 * Replace the second parameter (0) with the post id
                 * you want your file to be attached to
                 */
                $file_id = media_handle_upload('myfilefield', 0);

                if (!is_wp_error($file_id)) {
                    $result["file_id"] = $file_id;
                    $result["url"] = wp_get_attachment_url($file_id);
                    /*
                     * File uploaded successfully and you have the attachment id
                     * Do your stuff with the attachment id here
                    */
                }
            }
        }

        // //Send the sucess message
        // _e( 'Success', 'pixelnet');
    }
    echo json_encode($result);
    die();
}

function negarenovin_add_to_cart()
{
    WC()->cart->empty_cart();
    foreach ($_POST as $key => $post) {
        if ($key == "size_id") {
            WC()->cart->add_to_cart($post, 1, 0, array(), array('meta_plan_id' => $_POST["plan_id"]));
        } else if ($key == "ghab_id" && $post > 0) {
            WC()->cart->add_to_cart($post, 1);
        } else if ($key == "voice_id" && $post > 0) {
            if ($_POST["file_voice_id"] > 0) {
                WC()->cart->add_to_cart($post, 1, 0, array(), array('meta_voice_file' => $_POST["file_voice_id"]));
            }
        } else if ($key == "plan_id") {
        } else if (!str_contains($key, 'option-value-') && str_contains($key, 'option-')) {
            if (isset($_POST["option-value-" . $post])) {
                if (trim(strlen($_POST["option-value-" . $post]) > 0)) {
                    WC()->cart->add_to_cart($post, 1, 0, array(), array('meta_option_value' => $_POST["option-value-" . $post]));
                }
            } else {
                WC()->cart->add_to_cart($post, 1);
            }
        }
    }
}

//Hook our function to the action we set at jQuery code
add_action('wp_ajax_pn_wp_frontend_ajax_upload', 'pn_upload_files');
add_action('wp_ajax_nopriv_pn_wp_frontend_ajax_upload', 'pn_upload_files');

add_action('wp_ajax_pn_wp_frontend_ajax_order', 'negarenovin_add_to_cart');
add_action('wp_ajax_nopriv_pn_wp_frontend_ajax_order', 'negarenovin_add_to_cart');


if (function_exists('add_image_size')) {
    add_image_size('cart-thumb', 100, 100); // 100 wide and 100 high
}

class cartPlugins
{
    public function display_cart_item_custom_meta_data($item_data, $cart_item)
    {
        // Display custom cart item meta data (in cart and checkout)

        if (isset($cart_item['meta_plan_id'])) {
            $meta_key = 'طرح';
            $item_data[] = array(
                'key'       => $meta_key,
                'value'     => '<a style="color:red" target="_blank" href="' . wp_get_attachment_url($cart_item['meta_plan_id']) . '">مشاهده</a>',
            );
        } else if (isset($cart_item['meta_voice_file'])) {
            $meta_key = 'فرکانس صدا';
            $item_data[] = array(
                'key'       => $meta_key,
                'value'     => '<a style="color:red" target="_blank" href="' . wp_get_attachment_url($cart_item['meta_voice_file']) . '">دانلود</a>',
            );
        } else if (isset($cart_item['meta_option_value'])) {
            $meta_key = 'آپشن طراحی';
            $item_data[] = array(
                'key'       => $meta_key,
                'value'     => $cart_item['meta_option_value'],
            );
        }
        return $item_data;
    }
    public function save_cart_item_custom_meta_as_order_item_meta($item, $cart_item_key, $values, $order)
    {
        if (isset($values['meta_plan_id'])) {
            $meta_key = 'طرح';
            $item->update_meta_data($meta_key, '<a style="color:red" target="_blank" href="' . wp_get_attachment_url($values['meta_plan_id']) . '">مشاهده</a>');
        } else if (isset($values['meta_voice_file'])) {
            $meta_key = 'فرکانس صدا';
            $item->update_meta_data($meta_key, '<a style="color:red" target="_blank" href="' . wp_get_attachment_url($values['meta_voice_file']) . '">دانلود</a>');
        } else if (isset($values['meta_option_value'])) {
            $meta_key = 'آپشن طراحی';
            $item->update_meta_data($meta_key, $values['meta_option_value']);
        }
    }
    public function atapour_cart_on_checkout_page_only()
    {
        if (is_wc_endpoint_url('order-received')) return;
        echo do_shortcode('[woocommerce_cart]');
    }
}


$cartPlugins = new cartPlugins;
add_filter('woocommerce_get_item_data', array($cartPlugins, 'display_cart_item_custom_meta_data'), 10, 2);
add_action('woocommerce_checkout_create_order_line_item', array($cartPlugins, 'save_cart_item_custom_meta_as_order_item_meta'), 10, 4);
//add_action('woocommerce_before_checkout_form', array($cartPlugins, 'atapour_cart_on_checkout_page_only'), 5);

add_filter('show_admin_bar', '__return_false');


add_filter('pre_transient_wc_onboarding_themes', function ($flag, $transient) {

    return true;
}, 10, 2);

add_filter('pre_transient_wc_onboarding_product_data', function ($flag, $transient) {

    return ["fa_IR" => ["body"=>[]]];
}, 10, 2);

add_filter('woocommerce_admin_onboarding_themes', function ($themes) {

   if(!is_array($themes))
   {
    $themes=[];
   }
   return $themes;
}, 10, 2);
