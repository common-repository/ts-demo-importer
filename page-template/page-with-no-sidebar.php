<?php
/**
 * Template Name:Page with No Sidebar
 */

 get_header();
 include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' ); ?>

 <?php do_action('ts_demo_importer_before_nopage'); ?>
<main id="maincontent" role="main">
<div class="container">

      <?php while ( have_posts() ) : the_post(); ?>
         <?php the_content();?>
         <?php
         //If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() )
              comments_template();
         ?>
       <?php endwhile; // end of the loop. ?>

    <div class="clear"></div>

</div>
</main>
<?php do_action('ts_demo_importer_after_page'); ?>
<?php get_footer(); ?>
