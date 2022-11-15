<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Negarenovin
 *  * Template Name: وبلاگ
 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
get_header()
?>
<div class="content blog sidebar left-sidebar list">
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 py-5">
                    <div class="area-content-bySidebar ">
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb breadcrumb-singleProduct ">
                                <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">خانه</a></li>
                                <li class="breadcrumb-item"> <a href="#">وبلاگ</a></li>
                            </ol>
                        </nav>
                        <div class="title_site d-flex justify-content-start">
                            <h1>بلاگ</h1>
                        </div>
                        <div class="area-all-post mb-0 mb-md-3">
                            <div class="row">
                                <?php if ($the_query->have_posts()) { ?>
                                    <?php
                                    // Start the Loop.
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                    ?>
                                        <div class="col-12 mb-4 pb-2">
                                            <article class="card card-post d-flex flex-column flex-sm-row">
                                                <div class="hover01 column">
                                                    <figure style="height: 100%;"><a href="<?php echo get_permalink(); ?>" class="card-img d-block"><img src="<?php the_post_thumbnail_url(); ?>" class="<?php echo get_the_title(); ?>" /></a>
                                                    </figure>
                                                </div>
                                                <!-- <div class="hover01"> <figure> <a href="#" class="card-img d-block"><img src="images/img-post1.jpg" class="img-fluid h-100" ></a></figure> </div> -->
                                                <div class="card-body">
                                                    <ul class="post-categories mb-3 mb-md-4">
                                                        <?php
                                                        $posttags = get_the_tags();
                                                        if ($posttags) {
                                                            foreach ($posttags as $tag) {
                                                        ?>
                                                                <li><a href="<?php echo esc_attr(get_tag_link($tag->term_id)) ?>"><?php echo $tag->name ?> </a></li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                    <h2 class="title-post mb-2 mb-md-4"> <a href="#"></a><?php echo get_the_title(); ?></h2>
                                                    <div class="porofile_author porofile_author-listPost  mb-4">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <div class="porofileName">
                                                                <span>نویسنده:</span>
                                                                <span><?php get_the_author('first_name') ?></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="area-infoPost d-flex justify-content-end align-items-center">
                                                        <div class="border-divider"></div>
                                                        <a href="#" title="<?php echo get_the_date(); ?>" class="data-link">
                                                            <?php echo custom_get_the_date(get_the_ID()); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php
                                    // End the loop.
                                    endwhile;
                                    ?>

                            </div>
                        </div>
                        <div class="area-pageination-shop  d-flex  flex-column flex-md-row justify-content-between align-items-center mb-0 mb-md-3">
                            <div class="pagination wt-pagination">
                                <?php
                                    echo paginate_links(array(
                                        'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                        'total'        => $the_query->max_num_pages,
                                        'current'      => max(1, get_query_var('paged')),
                                        'format'       => '?paged=%#%',
                                        'show_all'     => false,
                                        'type'         => 'plain',
                                        'end_size'     => 2,
                                        'mid_size'     => 1,
                                        'prev_next'    => true,
                                        'prev_text'    => sprintf('<i></i> %1$s', __('بعدی', 'text-domain')),
                                        'next_text'    => sprintf('%1$s <i></i>', __('قبلی', 'text-domain')),
                                        'add_args'     => false,
                                        'add_fragment' => '',
                                    ));
                                ?>
                            </div>
                        </div>

                    <?php wp_reset_query();
                                } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>