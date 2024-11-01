<?php
/**
 * Template Name:Blog Full Width Extend
 */

get_header();
include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' ); ?>

<?php do_action('ts_demo_importer_before_blog');
$theme_lay = get_theme_mod( 'ts_demo_importer_plugin_single_blog_option','two_col');

  if($theme_lay == 'one_col'){
    $col_class = 'col-md-12 col-sm-12';
  }else if($theme_lay == 'two_col'){
    $col_class = 'col-lg-4 col-md-6 col-sm-6';
  }else{
    $col_class = 'col-md-4 col-sm-4';
  }
?>

<div id="full-width-blog">
	<main id="maincontent" role="main">
		<div class="container">
			<div class="section-title text-center pb-5 wow slideInUp delay-1000 animated" data-wow-duration="2s">
			  <?php if(get_theme_mod('ts_demo_importer_latest_news_heading',true)!=""){ ?>
			    <h2 class="coursehead">
			      <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_heading')); ?>
			    </h2>
			  <?php } ?>
			  <?php if (get_theme_mod('ts_demo_importer_latest_news_paragraph') != ''){?>
			    <p>
			      <?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_paragraph')); ?>
			    </p>
			  <?php } ?>
			</div>
			<div class="content_page row">
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
						<?php
						$p++; endwhile;
						wp_reset_postdata(); ?>
						<div class="navigation">
							<?php
							$big = 999999999;
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => 'paged=%#%',
								'current' =>  (get_query_var('paged') ? get_query_var('paged') : 1),
								'total' => $custom_query->max_num_pages
								)
							);
							?>
						</div>
					<?php else : ?>
						<h3>
							<?php esc_html_e('Not Found','ts-demo-importer'); ?></h3>
						<?php endif; ?>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
		</div>
	</main>
</div>

<?php do_action('ts_demo_importer_after_blog'); ?>

<?php get_footer(); ?>
