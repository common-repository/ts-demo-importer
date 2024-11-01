<?php
/**
 * The Template for displaying all single classes.
 *
 * @package multi-advance
 */
get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );  ?>

<div class="container mt-4">
    <div class="row">
        <div id="services_single" class="col-lg-8 col-md-7">
            <?php 
            while ($query->have_posts()) :
              $query->the_post(); ?>
            <div class="services-image">
                 <?php the_post_thumbnail(); ?> 
            </div>
            <div class="single-page-content pt-3"><?php the_content();?></div>     
            <div class="post_pagination mt-4">
                <?php the_post_navigation( array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'multi-advance' ) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Next post:', 'multi-advance' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'multi-advance' ) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Previous post:', 'multi-advance' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                ) );?>
            </div>
        </div>    
        <div class="col-lg-4 col-md-5" id="sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>   
        <div class="clearfix"></div>
        <?php endwhile; // end of the loop. ?> 
    </div>    
</div>
<?php get_footer(); ?>