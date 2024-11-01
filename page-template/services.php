<?php
/**
 * Template Name: Services
*/

get_header(); get_template_part( 'template-parts/banner' );
?>
<div class="services_page_template">

	<?php
		$count=get_theme_mod('ts_demo_importer_services_shortcodes_number', 2);

		for($i=1;$i<=$count;$i++)
		{
			echo do_shortcode(get_theme_mod('ts_demo_importer_services_inner_page_shortcode'.$i));
		}
	?>

	<div class="page_content_area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content();
		endwhile; // end of the loop. ?>
	</div>
</div>

<?php get_footer();
