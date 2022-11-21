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

    foreach ($roles as $role) {
        if ($role == "designer") {
            echo 'is designer';
        } else {
            echo 'is not designer';
        }
    }
}
