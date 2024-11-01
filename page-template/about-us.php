<?php
/**
 * Template Name: About Us
*/

get_header();

include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );

$template = wp_get_theme()->get( 'TextDomain' ); ?>

<?php if ( $template == 'advance-training-academy' ){
	if (get_theme_mod( 'ts_demo_importer_about_us_secone_enabledisable', true ) != '') {

		if( get_theme_mod('ts_demo_importer_about_us_secone_bgcolor','') ) {
		 $abt_one_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_about_us_secone_bgcolor','')).';';
		}elseif( get_theme_mod('ts_demo_importer_about_us_secone_bgimage','') ){
		 $abt_one_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_about_us_secone_bgimage')).'\')';
		}else{
		 $abt_one_backg='';
	 	} ?>

		<section class="about-us-section-one" style="<?php echo $abt_one_backg; ?>">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6" data-aos="zoom-in-down" data-aos-duration="2000">
					<?php if(get_theme_mod('ts_demo_importer_about_us_secone_left_img')!=''){ ?>
							<img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_about_us_secone_left_img')) ?>" alt="<?php echo esc_attr(get_theme_mod('ts_demo_importer_about_us_secone_left_img_alt_text')); ?>">
					<?php } ?>
					</div>
					<div class="col-lg-6" data-aos="zoom-in-up" data-aos-duration="2000">
						<?php if(get_theme_mod('ts_demo_importer_about_us_secone_heading')!=''){ ?>
							<h2 class="about-us-heading">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secone_heading')); ?>
							</h2>
						<?php } ?>
					<?php if(get_theme_mod('ts_demo_importer_about_us_secone_para_one')!=''){ ?>
							<p class="about-us-para">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secone_para_one')); ?>
							</p>
						<?php } ?>
					<?php if(get_theme_mod('ts_demo_importer_about_us_secone_para_two')!=''){ ?>
							<p class="about-us-para">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secone_para_two')); ?>
							</p>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>

	<?php if ( get_theme_mod('ts_demo_importer_about_us_inner_page_sec_two_show_hide', 'true') !='' ) {
		echo do_shortcode(get_theme_mod('ts_demo_importer_about_us_inner_page_shortcode'));
	} ?>


	<?php

	if (get_theme_mod( 'ts_demo_importer_about_us_secthree_enabledisable', true ) != '') {
			if( get_theme_mod('ts_demo_importer_about_us_secthree_bgcolor','') ) {
			 $abt_three_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_about_us_secthree_bgcolor','')).';';
		 }elseif( get_theme_mod('ts_demo_importer_about_us_secthree_bgimage','') ){
			 $abt_three_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_about_us_secthree_bgimage')).'\')';
			}else{
			 $abt_three_backg='';
	 } ?>
		<section class="about-us-section-three" sytle="<?php echo $abt_three_backg; ?>">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 text-lg-end">
					<?php if(get_theme_mod('ts_demo_importer_about_us_secthree_heading')!=''){ ?>
							<h2 class="about-us-heading">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secthree_heading')); ?>
							</h2>
						<?php } ?>
					<?php if(get_theme_mod('ts_demo_importer_about_us_secthree_para_one')!=''){ ?>
							<p class="about-us-para">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secthree_para_one')); ?>
							</p>
						<?php } ?>
					<?php if(get_theme_mod('ts_demo_importer_about_us_secthree_para_two')!=''){ ?>
							<p class="about-us-para">
								<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secthree_para_two')); ?>
							</p>
						<?php } ?>
					</div>
					<div class="col-lg-6">
						<div class="video-cols" data-aos="zoom-in-down" data-aos-duration="2000">
							<div class="abt-video">
								<div class="abt-video-box position-relative">
									<?php if(get_theme_mod('ts_demo_importer_about_us_secthree_video_image')!=''){ ?>
										<img src="<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secthree_video_image')); ?>" alt="video-image" class="img-fluid">
									<?php }?>
									<div class="video-icon-box">
										<?php if(get_theme_mod('ts_demo_importer_about_us_secthree_video_icon')!=''){ ?>
												<a data-toggle="modal" href="#about_page_modal" id="myBtn">
													<i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_about_us_secthree_video_icon')); ?>"></i>
													<span class="screen-reader-text">
														<?php echo esc_html('video button', 'ts-demo-importer' ) ; ?>
													</span>
												</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div id="about_page_modal" class="video-modal-new">
			<div class="modal-contents">
				<button class="close-one">&times;
					<span class="screen-reader-text">
						<?php echo esc_html('Close button', 'ts-demo-importer' ) ; ?>
					</span>
				</button>
				<?php if( get_theme_mod('ts_demo_importer_about_us_secthree_video_link') != ''){ ?>
					<embed width="100%" height="345" src=" <?php echo (get_theme_mod('ts_demo_importer_about_us_secthree_video_link')); ?>">
					</embed>
				<?php }else{ ?>
				<h3><?php esc_html_e('Add Embedded Video Url In Customizer To Display Video Here','ts-demo-importer'); ?></h3>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

<?php } else{ ?>
	<div class="about_us_page_template">
		<?php
		$count=get_theme_mod('ts_demo_importer_shortcodes_number', 5);

		for($i=1;$i<=$count;$i++)
		{
			echo do_shortcode(get_theme_mod('ts_demo_importer_about_us_inner_page_shortcode'.$i));
		}
		?>

		<div class="page_content_area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content();
			endwhile; // end of the loop. ?>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>
