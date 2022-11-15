<?php
get_header()
?>
<div class="container mt-4">
  <section>
    <div class="row">
      <div class="col-12">
        <?php
        if (have_posts()) {
        ?>
        <?php
          // Load posts loop.
          while (have_posts()) {
            the_post();
            get_template_part('template-parts/content/content', 'page');
          }
        } else {


          // If no content, include the "No posts found" template.
          get_template_part('template-parts/content/content', 'none');
        }
        ?>
      </div>

    </div>
  </section>
</div>

<?php get_footer() ?>