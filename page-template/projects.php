<?php
/**
 * Template Name: project
*/

get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );

?>
<div class="project_page_template">

	<?php
		$count=get_theme_mod('ts_demo_importer_project_shortcodes_number', 1);

		for($i=1;$i<=$count;$i++)
		{
			echo do_shortcode(get_theme_mod('ts_demo_importer_project_inner_page_shortcode'.$i));
		}
	?>

	<div class="page_content_area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content();
		endwhile; // end of the loop. ?>
	</div>
</div>

<?php get_footer();
