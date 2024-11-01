<?php
/**
 * Template Name:Blog with Right Sidebar
 */

get_header();
include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' ); ?>

<?php do_action('ts_demo_importer_before_blog');
$theme_lay = get_theme_mod( 'ts_demo_importer_plugin_single_blog_option','two_col');

  if($theme_lay == 'one_col'){
    $col_class = 'col-md-12 col-sm-12';
  }else if($theme_lay == 'two_col'){
    $col_class = 'col-md-6 col-sm-6';
  }else{
    $col_class = 'col-md-4 col-sm-4';
  }
	?>

<div id="blog-right-sidebar">
	<main id="maincontent" role="main">
	<div class="container">
	    <div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="row">
					<?php if ( have_posts() ) : ?>
				      	<?php $ts_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							$args = array(
							   'paged' => $ts_paged,
							   'category_name' => get_theme_mod('ts_demo_importer_category_setting')
							);
						$custom_query = new WP_Query( $args );
						while($custom_query->have_posts()) :
						   $custom_query->the_post(); ?>
							 <div class="<?php echo esc_attr($col_class); ?> mb-3">
								 <?php	include( plugin_dir_path(__DIR__ ) . 'template-parts/post/post-content.php' ); ?>
							 </div>
							 <?php endwhile; // end of the loop.
						wp_reset_postdata(); ?>
					<?php else : ?>
						<h2><?php _e('Not Found','ts-demo-importer'); ?></h2>
					<?php endif; ?>
				</div>
				<div class="navigation">
	              	<?php
						$big = 999999999;
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => 'paged=%#%',
							'current' =>  (get_query_var('paged') ? get_query_var('paged') : 1),
							'total' => $custom_query->max_num_pages
						) );
					?>
	            </div>
			</div>
			<div class="col-lg-4 col-md-12" id="sidebar">
				<?php dynamic_sidebar('sidebar-1'); ?>
				 <?php dynamic_sidebar('sidebar-2'); ?>
			</div>
	        <div class="clearfix"></div>
	    </div>
	</div>
	</main>
</div>

<?php do_action('ts_demo_importer_after_blog'); ?>

<?php get_footer(); ?>
