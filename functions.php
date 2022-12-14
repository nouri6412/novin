<?php
/// ajax
function novin_theme_scripts()
{
    global $wp_query;

    wp_enqueue_script(
        'novin_ajax_script',
        get_template_directory_uri() . '/assets/js/ajax-v36.js',
        array('jquery'),
        1,
        false
    );

    wp_localize_script('novin_ajax_script', 'custom_theme_mbm_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => site_url(),
    ));
}



function negarehnovin_setup()
{
    add_theme_support('title-tag');

    /**
     * Add post-formats support.
     */
    add_theme_support(
        'post-formats',
        array(
            'link',
            'aside',
            'gallery',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        )
    );
}

add_action('after_setup_theme', 'negarehnovin_setup');

add_action('wp_enqueue_scripts', 'novin_theme_scripts');

function custom_get_the_date($post)
{
    return human_time_diff(get_the_time('U', $post), current_time('timestamp')) . ' ' . 'پیش';
}

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

                    if (isset($_POST["chat_id"])) {
                        $user = wp_get_current_user();
                        $chat = ["type" => "img", "user_id" => $user->ID, "date" => date('Y-m-d H:i:s'), "img" => $file_id];

                        $chats = json_decode(get_post_meta($_POST["chat_id"], 'chats-file', true), true);
                        $chats[] = $chat;

                        $json = json_encode($chats, JSON_UNESCAPED_UNICODE);

                        update_post_meta($_POST["chat_id"], "chats-file", $json);
                    }
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

function gregorian_to_jalali_tr_num($str, $mod = 'en', $mf = '٫')
{
    $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $key_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', $mf);
    return ($mod == 'fa') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
}

function gregorian_to_jalali($in_date)
{
    $ddd = strtotime($in_date);
    $mod = '';
    $gy = date("Y", $ddd);
    $gm = date("m", $ddd);
    $gd = date("d", $ddd);


    list($gy, $gm, $gd) = explode('_', gregorian_to_jalali_tr_num($gy . '_' . $gm . '_' . $gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    if ($gy > 1600) {
        $jy = 979;
        $gy -= 1600;
    } else {
        $jy = 0;
        $gy -= 621;
    }
    $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
    $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
    $jy += 33 * ((int)($days / 12053));
    $days %= 12053;
    $jy += 4 * ((int)($days / 1461));
    $days %= 1461;
    $jy += (int)(($days - 1) / 365);
    if ($days > 365) $days = ($days - 1) % 365;
    if ($days < 186) {
        $jm = 1 + (int)($days / 31);
        $jd = 1 + ($days % 31);
    } else {
        $jm = 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days - 186) % 30);
    }

    return $jy . '/' . $jm . '/' . $jd;
}

function negarenovin_add_to_cart()
{
    // WC()->cart->empty_cart();
    foreach ($_POST as $key => $post) {
        if ($key == "size_id") {
            WC()->cart->add_to_cart($post, 1, 0, array(), array('meta_plan_id' => $_POST["plan_id"], 'meta_plan_type' => $_POST["plan_type"]));
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

            $image = "";
            $plan_type = $cart_item['meta_plan_type'];

            if ($plan_type == 0) {
                if (has_post_thumbnail($cart_item['meta_plan_id'])) {
                    $image = get_the_post_thumbnail_url($cart_item['meta_plan_id'], '');
                } else {
                    $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                }
                $item_data[] = array(
                    'key'       => $meta_key,
                    'value'     => '<a style="color:red" target="_blank" href="' . $image . '">' . get_the_title($cart_item['meta_plan_id']) . '</a>',
                );
            } else {
                $ex = explode(',', $cart_item['meta_plan_id']);
                $image = "";
                if (count($ex) > 1) {

                    foreach ($ex as $it) {

                        $image_id = wp_get_attachment_url($it);
                        $img = '<img style="width:40px" src="' . $image_id . '" />';
                        $image .= '<a style="color:red" target="_blank" href="' . $image_id . '">' . $img . '</a>';
                    }
                } else {
                    $image_id = wp_get_attachment_url($cart_item['meta_plan_id']);
                    $img = '<img style="width:40px" src="' . $image_id . '" />';
                    $image = '<a style="color:red;margin-left: 20px;" target="_blank" href="' . $image_id . '">' . $img . '</a>';
                }


                $item_data[] = array(
                    'key'       => $meta_key,
                    'value'     => $image,
                );
            }
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

            $image = "";

            $plan_type = $values['meta_plan_type'];

            if (has_post_thumbnail($values['meta_plan_id'])) {
                $image = get_the_post_thumbnail_url($values['meta_plan_id'], '');
            } else {
                $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
            }
            if ($plan_type == 0) {
                if (has_post_thumbnail($values['meta_plan_id'])) {
                    $image = get_the_post_thumbnail_url($values['meta_plan_id'], '');
                } else {
                    $image = get_template_directory_uri() . "/assets/img/bg-black-2.png";
                }
                $item->update_meta_data($meta_key, '<a style="color:red" target="_blank" href="' . $image . '">' . get_the_title($values['meta_plan_id']) . '</a>');
            } else {
                $ex = explode(',', $values['meta_plan_id']);
                $image = "";
                if (count($ex) > 1) {
                    $index_row = 0;
                    foreach ($ex as $it) {

                        $image_id = wp_get_attachment_url($it);
                        $img = '<img style="width:40px" src="' . $image_id . '" />';
                        $image .= '<a style="color:red;margin-left: 20px;" target="_blank" href="' . $image_id . '">' . $img . '</a>';
                    }
                } else {
                    $image_id = wp_get_attachment_url($values['meta_plan_id']);
                    $img = '<img style="width:40px" src="' . $image_id . '" />';
                    $image = '<a style="color:red" target="_blank" href="' . $image_id . '">' . $img . '</a>';
                }
                $item->update_meta_data($meta_key, $image);
            }
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

    return ["fa_IR" => ["body" => "{}"]];
}, 10, 2);

add_filter('woocommerce_admin_onboarding_themes', function ($themes) {

    if (!is_array($themes)) {
        $themes = [];
    }
    return $themes;
}, 10, 2);



function kaktos_post_type_plan()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
        'editor',
        'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats

    );

    $labels = array(
        'name' => _x('طرح', 'plural'),
        'singular_name' => _x('طرح', 'singular'),
        'menu_name' => _x('طرح', 'admin menu'),
        'name_admin_bar' => _x('طرح', 'admin bar'),
        'add_new' => _x('ثبت طرح جدید', 'add new'),
        'add_new_item' => "ثبت طرح جدید",
        'new_item' => "طرح جدید",
        'edit_item' => "ویرایش طرح",
        'view_item' => "مشاهده طرح",
        'all_items' => "همه طرح ها",
        'search_items' => "جستجوی طرح",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'plan'),
        'has_archive' => true,
        'taxonomies'         => array('category', 'post_tag'),
        'hierarchical' => false
    );
    register_post_type('plan', $args);
}
add_action('init', 'kaktos_post_type_plan');

add_filter('woocommerce_checkout_fields', 'remove_company_name');

function remove_company_name($fields)
{

    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_last_name']);

    $fields['billing']['billing_first_name']['priority'] = 10;
    //  $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_country']['priority'] = 30;
    $fields['billing']['billing_state']['priority'] = 40;
    $fields['billing']['billing_city']['priority'] = 50;
    $fields['billing']['billing_address_1']['priority'] = 60;
    $fields['billing']['billing_postcode']['priority'] = 70;
    $fields['billing']['billing_phone']['priority'] = 80;
    $fields['billing']['billing_email']['priority'] = 100;

    $fields['billing']['billing_postcode']['required'] = false;
    $fields['billing']['billing_email']['required'] = false;

    $fields['billing']['billing_first_name']['label'] = "نام و نام خانوادگی";
    $fields['billing']['billing_address_1']['label'] = "آدرس";
    $fields['billing']['billing_phone']['label'] = "موبایل";
    $fields['billing']['billing_first_name']['class'][0] = "form-row-wide";

    $fields['billing']['billing_tel_0'] = ["label" => "شماره ثابت", "priority" => 80, 'required' => false];


    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_last_name']);

    $fields['shipping']['shipping_first_name']['priority'] = 10;
    //  $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['shipping']['shipping_country']['priority'] = 30;
    $fields['shipping']['shipping_state']['priority'] = 40;
    $fields['shipping']['shipping_city']['priority'] = 50;
    $fields['shipping']['shipping_address_1']['priority'] = 60;
    $fields['shipping']['shipping_postcode']['priority'] = 70;

    $fields['shipping']['shipping_postcode']['required'] = false;

    $fields['shipping']['shipping_first_name']['label'] = "نام و نام خانوادگی";
    $fields['shipping']['shipping_address_1']['label'] = "آدرس";
    // $fields['shipping']['shipping_phone']['label'] = "موبایل";
    $fields['shipping']['shipping_first_name']['class'][0] = "form-row-wide";

    //$fields['shipping']['shipping_tel_0']=["label"=>"شماره ثابت","priority"=>80,'required'=>false];


    return $fields;
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'تنظیمات  قالب  ',
        'menu_title'    => 'تنظیمات  قالب ',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'فوتر',
        'menu_title'    => 'فوتر',
        'menu_slug'     => 'theme-general-settings-footer',
        'parent_slug'    => 'theme-general-settings',
    ));
}

foreach (glob(get_template_directory() . "/inc/*.php") as $filename) {
    require $filename;
}

function is_site_admin_v1()
{
    return in_array('administrator',  wp_get_current_user()->roles);
}

add_filter('manage_edit-shop_order_columns', 'custom_shop_order_column', 20);
function custom_shop_order_column($columns)
{
    $reordered_columns = array();

    // Inserting columns to a specific location
    foreach ($columns as $key => $column) {
        $reordered_columns[$key] = $column;
        if ($key ==  'order_status') {
            // Inserting after "Status" column
            $reordered_columns['chat_files'] = 'طراح و فایل ها';
        }
    }
    return $reordered_columns;
}

// Adding custom fields meta data for each new column (example)
add_action('manage_shop_order_posts_custom_column', 'custom_orders_list_column_content', 20, 2);
function custom_orders_list_column_content($column, $post_id)
{
    switch ($column) {
        case 'chat_files':
            $designer_id =  get_post_meta($post_id, 'send-to-designer', true);
            $text = "طراح ندارد";
            if (strlen($designer_id) > 0) {

                $designer = get_user_by('id', $designer_id);
                $user_meta = get_user_meta($designer_id);

                $name = isset($user_meta['first_name']) ? $user_meta['first_name'][0] : '';
                $last_name = isset($user_meta['last_name']) ? $user_meta['last_name'][0] : '';

                $text = $designer->display_name . ' - ' . $name . ' ' . $last_name;
                echo '<a target="_blank" href="' . site_url('my-account/send-file?order_id=' . $post_id) . '" style="color:green;">' . $text . '</a>';
            } else {
                echo '<a target="_blank" href="' . site_url('my-account/send-file?order_id=' . $post_id) . '" style="color:red;">' . $text . '</a>';
            }

            break;

        case 'my-column2222':
            $text = "";
            break;
    }
}
function custom_get_price_html($product)
{
    $price = '';
    if ('' === $product->get_price()) {
        $price = apply_filters('woocommerce_empty_price_html', '', $product);
    } elseif ($product->is_on_sale()) {
        $price = '<del aria-hidden="true" style="font-size: 14px;"><span class="woocommerce-Price-amount amount"><bdi>' . number_format($product->get_regular_price()) . '<span style="margin-right: 5px;" class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span></bdi></span></del>';
        $price .= '<div><span class="woocommerce-Price-amount amount"><span>' . number_format($product->get_price()) . '<span style="margin-right: 5px;" class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span></span></span></div>';

        //  $price = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
    } else {
        $price = '<div><span class="woocommerce-Price-amount amount"><span>' . number_format($product->get_price()) . '<span style="margin-right: 5px;" class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span></span></span></div>';
    }

    return $price;
}

add_filter('wf_pklist_alter_template_html', 'wt_pklist_add_custom_css_in_invoice_html', 10, 2);
function wt_pklist_add_custom_css_in_invoice_html($html, $template_type)
{

    /* add cutsom css in invoice */
 
    if ($template_type == 'invoice') {

        $html .= '<link rel="stylesheet" href="'.  get_template_directory_uri().'/style-pdf.css?ver=1.1.1">';
    }

    return $html;
}


// define( 'WP_HTTP_BLOCK_EXTERNAL', true ); config file
// define('WP_ACCESSIBLE_HOSTS','mihanwp.com, wordpress.org');