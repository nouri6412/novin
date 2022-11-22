<?php
add_filter('woocommerce_account_menu_items', 'silva_send_file_link', 40);
function silva_send_file_link($menu_links)
{
    $user = wp_get_current_user(); // getting & setting the current user 
    $roles = (array) $user->roles; // obtaining the role 

    foreach ($roles as $role) {
        if ($role == "designer") {
            $menu_links = array_slice($menu_links, 0, 2, true)
                + array('send-file' => 'ارسال فایل')
                + array_slice($menu_links, 2, NULL, true);
        }
    }


    return $menu_links;
}
/*
 * Part 2. Register Permalink Endpoint
 */
add_action('init', 'silva_add_endpoint');
function silva_add_endpoint()
{

    // WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
    add_rewrite_endpoint('send-file', EP_PAGES);
}
/*
 * Part 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action('woocommerce_account_send-file_endpoint', 'silva_my_account_endpoint_content');
function silva_my_account_endpoint_content()
{

    $user = wp_get_current_user(); // getting & setting the current user 
    $roles = (array) $user->roles; // obtaining the role 

    if (isset($_GET["order_id"])) {


        $order_id = $_GET["order_id"];

        $chats = json_decode(get_post_meta($order_id, 'chats-file', true), true);

        if (isset($_POST["chat-message-body"])) {
            if (strlen(trim($_POST["chat-message-body"])) > 0) {
                $chat = ["type" => "text", "user_id" => $user->ID, "date" => date('Y-m-d H:i:s'), "body" => $_POST["chat-message-body"]];
                $chats[] = $chat;
                $json = json_encode($chats, JSON_UNESCAPED_UNICODE);

                update_post_meta($order_id, "chats-file", $json);
            }
        }

        $designer_id =  get_post_meta($order_id, 'send-to-designer', true);



        $order =  wc_get_order($order_id);

        $sender_id = $order->get_user_id();
        $user_id = $user->ID;
        $items = $order->get_items();

        foreach ($items as $item_id=>$cart_item) {
           echo '<div>item_id'.$item_id.' : '."plan_id : ". wc_get_order_item_meta($item_id,'meta_plan_id',true).'</div>';
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
                        $image = '<a style="color:red;margin-left: 20px;" target="_blank" href="' . $img . '"></a>';
                    }
                }
                echo $image;
            }
        }


        // echo '<div>'.'des:'.$designer_id.'</div>'.'<div>'.' user:'.$user->ID.'</div>';

        if ($designer_id == $user->ID) {
            $me_type = 1;
            include "view/form-chat.php";
        } else if ($sender_id == $user->ID) {
            $me_type = 2;
            include "view/form-chat.php";
        } else if (is_site_admin_v1()) {
            $me_type = 3;
            include "view/form-chat.php";
        }
    } else {
        foreach ($roles as $role) {
            if ($role == "designer") {

                $args = array(
                    'post_type' => 'shop_order',
                    'meta_key' => 'send-to-designer',
                    'meta_value' => $user->ID,
                    "post_status"    => 'any',
                    "order" => "DESC"
                );

                $the_query = new WP_Query($args);
                $count = $the_query->post_count;
                if ($count == 0) {
                    echo '<h2>' . 'چیزی برای نمایش وجود ندارد' . '</h2>';
                } else {
                    include "view/list-file.php";
                }
            } else {
                //  echo 'is not designer';
            }
        }
    }
}
