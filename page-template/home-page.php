<?php
/**
 * Template Name: Home Page
 */
get_header();



  

		include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-slider.php' );

		$section_order ='';
		$section_order = explode( ',', get_theme_mod( 'ts_demo_importer_section_ordering_settings_repeater') );

	    foreach( $section_order as $key => $value ){
		   if($value !=''){

		   	include( plugin_dir_path(__DIR__ ) . '/template-parts/home/section-'.$value.'.php' );

	        }

	}
get_footer(); ?>
