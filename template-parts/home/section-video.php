<?php
$section_hide = get_theme_mod( 'ts_demo_importer_video_enabledisable' );
if ( 'Disable' == $section_hide ) {
  return;
}
if( get_theme_mod('ts_demo_importer_video_bgcolor','') ) {
  $video_backg = 'background: linear-gradient(to bottom, #fff 0% 50%, '.esc_attr(get_theme_mod('ts_demo_importer_video_bgcolor')).' 50%);';
	}elseif( get_theme_mod('ts_demo_importer_video_bgimage','') ){
		$video_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_video_bgimage')).'\')';
	}else{
		$video_backg = '';
	}

if( get_theme_mod('ts_demo_importer_video_bg_attachemnt','scroll') ) {
	$video_backg_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_video_bg_attachemnt','')).';';
}else {
  $video_backg_att = '';
}

  ?>
<section id="video" style="<?php echo esc_attr($video_backg. ';' .$video_backg_att); ?>" class="position-relative video">
	<div class="container">
			<div class="video-cols">
				<div class="abt-video">
					<div class="abt-video-box position-relative">
						<?php if(get_theme_mod('ts_demo_importer_video_image')!=''){ ?>
						  <img src="<?php echo esc_html(get_theme_mod('ts_demo_importer_video_image')); ?>" alt="video-image" class="img-fluid">
						<?php }?>
						<div class="video-content-box text-center">
							<div class="video-title">
								<?php if (get_theme_mod('ts_demo_importer_video_title') != '') { ?>
									<h2>
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_video_title')); ?>
                  </h2>
								<?php } ?>
								<?php if (get_theme_mod('ts_demo_importer_video_text') != '') { ?>
									<p>
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_video_text')); ?>
                  </p>
								<?php } ?>
							</div>
							<div class="video-icon-box">
								<?php if(get_theme_mod('ts_demo_importer_video_icon')!=''){ ?>
								    <a data-toggle="modal" href="#myModal" id="myBtn">
                      <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_video_icon')); ?>"></i>
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
</section>
<div id="myNewModal" class="video-modal-new">
	<div class="modal-contents">
		<button class="close-one">&times;<span class="screen-reader-text"><?php echo esc_html('Close button', 'ts-demo-importer' ) ; ?></span></button>
		<?php if( get_theme_mod('ts_demo_importer_video_link') != ''){ ?>
			<embed width="100%" height="345" src=" <?php echo (get_theme_mod('ts_demo_importer_video_link')); ?>">
			</embed>
		<?php }else{ ?>
		<h3><?php esc_html_e('Add Embedded Video Url In Customizer To Display Video Here','ts-demo-importer'); ?></h3>
		<?php } ?>
	</div>
</div>
