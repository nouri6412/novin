<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Negharenovin
 * @since Negharenovin 1.0
 */

get_header('order');
?>
<!-- Content -->

    <?php

    // Start the Loop.
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content/content', 'page');

    endwhile; // End the loop.
    ?>

<!-- Content END-->
<?php
get_footer('order');
