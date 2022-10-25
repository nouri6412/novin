<?php
/// ajax
function novin_theme_scripts()
{
    global $wp_query;

    wp_enqueue_script(
        'novin_ajax_script',
        get_template_directory_uri() . '/assets/js/ajax-v6.js',
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
                    $result["url"]= wp_get_attachment_url($file_id);
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

//Hook our function to the action we set at jQuery code
add_action('wp_ajax_pn_wp_frontend_ajax_upload', 'pn_upload_files');
add_action('wp_ajax_nopriv_pn_wp_frontend_ajax_upload', 'pn_upload_files');
