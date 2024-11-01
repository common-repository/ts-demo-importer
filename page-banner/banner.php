<?php
if ( ! is_singular() ) {
	return;
}
global $post;
$img = get_post_meta($post->ID, 'title_banner_image_wp_custom_attachment', true);

$page_short_title = get_post_meta($post->ID, 'title_banner_image_title_short', true);

$display = '';
$display_title_bbanner = '';
$title_banner_image_title_on_banner_on_off = get_post_meta($post->ID, 'title_banner_image_title_on_banner_on_off', true);
$title_banner_image_title_below_on_off = get_post_meta($post->ID, 'title_banner_image_title_below_on_off', true);
$title_banner_image_title_hide_or_show_breadcrumb = get_post_meta($post->ID, 'title_banner_image_title_hide_or_show_breadcrumb', true);

if( $img != '' ){ ?>
	<div class="banner_title_box">
		<?php if($img !='') { ?>
			<img src="<?php echo esc_url($img); ?>">
		<?php } ?>

		<?php if( $title_banner_image_title_on_banner_on_off != '' ){ ?>
			<div class="content_on_banner">
				<div class="container">
					<div class="banner-bgcolor">
						<span class="page_short_title"><?php echo esc_html($page_short_title);?></span>
						<h1><?php the_title();?></h1>
						<?php if( $title_banner_image_title_hide_or_show_breadcrumb != '' ){
			        	 echo ts_breadcrumbs();
						} ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="bg_color_overlay"></div>
	</div>
<?php } ?>

<?php if( $title_banner_image_title_below_on_off != '' ){ ?>
	<div class="banner_title_box">
		<div class="content_on_banner">
			<div class="container">
				<h1 class="text-dark">
					<?php the_title();?>
				</h1>
				<?php if( $title_banner_image_title_hide_or_show_breadcrumb != '' ){
						 echo ts_breadcrumbs();
				} ?>
			</div>
		</div>
	</div>
<?php } ?>
 <?php /* else {?>
	<div class="banner_title_box">
		<?php if($img !='') { ?>
			<img src="<?php echo esc_url($img); ?>">
		<?php } else { ?>
			<img src="<?php echo esc_url(TS_DEMO_IMPOTER_URL.'/assets/images/banner.png'); ?>">
		<?php } ?>
		<div class="container content_below_banner">
			<div class="above_title ">
				<h1><?php the_title();?></h1>
				<span class="page_short_title"><?php echo esc_html($page_short_title);?></span>
				<?php if(get_theme_mod('ts_demo_importer_site_breadcrumb_enable',true)){
	        	  	echo ts_breadcrumbs();
	        	} ?>
			</div>
		</div>
		<div class="bg_color_overlay"></div>
	</div>
<?php } */
