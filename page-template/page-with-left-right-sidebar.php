<?php
/**
 * Template Name:Page Left / Right Sidebar
 */

get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' ); ?>

<?php do_action('ts_demo_importer_before_page'); ?>

<div class="container page-left-right-sidebar">
  <div class="row">
    <div class="col-lg-3 col-md-5" id="sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
    <div class="col-lg-6 col-md-7 content_page">
      <?php while ( have_posts() ) : the_post(); ?>
         <?php the_content();?>
         <?php
         //If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() )
              comments_template();
         ?>
       <?php endwhile; // end of the loop. ?>
    </div>
    <div class="col-lg-3 col-md-5" id="sidebar">
      <?php dynamic_sidebar('sidebar-2'); ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php do_action('ts_demo_importer_after_page'); ?>
<?php get_footer(); ?>
