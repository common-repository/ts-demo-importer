<?php
/**
 * Template Name: hiring
*/

get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );

?>
<div class="hiring_page_template">

	<?php
		$count=get_theme_mod('ts_demo_importer_hiring_shortcodes_number');

		for($i=1;$i<=$count;$i++)
		{
			echo do_shortcode(get_theme_mod('ts_demo_importer_hiring_inner_page_shortcode'.$i));
		}


		// echo do_shortcode(get_theme_mod('ts_demo_importer_hiring_inner_page_shortcode2'));

	?>

	<div class="page_content_area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content();
		endwhile; // end of the loop. ?>
	</div>
</div>

<?php get_footer();
