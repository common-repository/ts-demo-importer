<?php

/**
 * Template to show the content of Slider
 *
 * @package ts-demo-importer
 */

$section_hide = get_theme_mod( 'ts_demo_importer_slider_enabledisable' );


if ( 'Disable' == $section_hide ) {
  return;
}
$number = get_theme_mod('ts_demo_importer_slide_number');
$slide_delay = get_theme_mod('ts_demo_importer_slide_delay');
$template = wp_get_theme()->get( 'TextDomain' );
if($number != ''){

?>
  <section id="slider">
    <?php if ( $template == 'multi-advance' ) { ?>
      <div id="carouselindicators" class="carousel slide <?php if ( get_theme_mod('ts_demo_importer_slide_remove_fade',true) == 1 ) { ?> carousel-fade <?php } ?>" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr($slide_delay); ?>">
        <div class="carousel-inner" role="listbox">
          <?php for ($i=1; $i<=$number; $i++) {  ?>
              <?php
                if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_gradient" ){

                  $slide_color_1 = get_theme_mod('ts_demo_importer_slide_background_color_one'.$i);
                  $slide_color_2 = get_theme_mod('ts_demo_importer_slide_background_color_two'.$i);

                  $slide_gradient = 'background-image:linear-gradient(to right,'.esc_attr($slide_color_1).' , '.esc_attr($slide_color_2).');';

                  $slide_height = 'height:'.esc_html(get_theme_mod('ts_demo_importer_slide_height'.$i)).'px;';
                }

              ?>

              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?> <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i) == "slide_type_gradient" ){ ?> style="<?php echo esc_attr($slide_gradient); ?><?php if($slide_height != ''){ echo esc_attr($slide_height); } ?>"
              <?php } ?>>

                <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_image" ){ ?>
                  <?php if ( get_theme_mod('ts_demo_importer_slide_image'.$i) != "" ) { ?>
                    <img  src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_image_alt_text'.$i)); ?>" <?php if($i == 2 || $i == 3 || $i == 4){ ?> loading="lazy" <?php } ?>>
                  <?php }
                }
                elseif(get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_video"){
                  if ( get_theme_mod('ts_demo_importer_slide_vide_link'.$i,true) != "" ) {?>
                    <video id="background-video" autoplay loop muted poster="">
                      <source src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_vide_link'.$i)); ?>" type="video/mp4">
                    </video>
                  <?php }
                } ?>

                <?php if ( get_theme_mod('ts_demo_importer_slide_heading'.$i) != "" || get_theme_mod('ts_demo_importer_slide_text'.$i) != "") {?>
                    <div class="carousel-caption d-md-block mt-5">
                      <div class="container h-100 position-relative">
                          <div class="inner_carousel">
                            <div class="slider-box">
                              <div class="" data-aos="zoom-in-left" data-aos-duration="2000">
                                  <div class="inner_slide">
                                    <span class="smalltext animated fadeInRight">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_small_heading'.$i)); ?>
                                    </span>
                                    <h3 class="animated fadeInLeft">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_heading'.$i)); ?>
                                    </h3>
                                    <div class="animated fadeInRight slide_p">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_text'.$i)); ?>
                                    </div>
                                    <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i) != ''){ ?>
                                      <a class="read-more animated fadeInLeft theme_button2 mr-4" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_url'.$i)); ?>">
                                        <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i)); ?>
                                        <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i) != ''){ ?>
                                          <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i)); ?>"></i>
                                        <?php } ?>
                                      </a>
                                    <?php } ?>
                                  </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <?php if ( get_theme_mod('ts_demo_importer_slider_arrows',true) == "1" ) { ?>
                          <div class="slide_nav">
                            <a class="carousel-prev-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
                              <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
                            </a>
                            <a class="carousel-next-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
                              <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
                            </a>
                          </div>
                        <?php }?>
                    </div>
                <?php } ?>
              </div>
            <?php } ?>
        </div>

        <?php if ( get_theme_mod('ts_demo_importer_slider_dots',true) == "1" ) { ?>
          <div class="container custom_cls">
            <ol class="carousel-indicators">
              <?php for($i=1;$i<=$number;$i++){ ?>
                <li data-bs-target="#carouselindicators" data-bs-slide-to="<?php echo($i-1); ?>" class="<?php if($i==1){echo 'active';} ?>"></li>
              <?php } ?>
            </ol>
          </div>
        <?php } ?>
      </div>

      <!-- Slider 2 -->
    <?php } elseif ( $template == 'advance-marketing-agency' ) {  ?>
      <div id="carouselindicators" class="carousel slide <?php if ( get_theme_mod('ts_demo_importer_slide_remove_fade',true) == 1 ) { ?> carousel-fade <?php } ?>" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr($slide_delay); ?>">
      <div class="carousel-inner">
        <?php for ($i=1; $i<=$number; $i++) {  ?>
          <?php
            if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_gradient" ){

              $slide_color_1 = get_theme_mod('ts_demo_importer_slide_background_color_one'.$i);
              $slide_color_2 = get_theme_mod('ts_demo_importer_slide_background_color_two'.$i);

              $slide_gradient = 'background-image:linear-gradient(to right,'.esc_attr($slide_color_1).' , '.esc_attr($slide_color_2).');';

              $slide_height = 'height:'.esc_html(get_theme_mod('ts_demo_importer_slide_height'.$i)).'px;';
            }

          ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?> <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i) == "slide_type_gradient" ){ ?> style="<?php echo esc_attr($slide_gradient); ?><?php if($slide_height != ''){ echo esc_attr($slide_height); } ?>"
              <?php } ?>>

              <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_image" ){ ?>
              <?php if ( get_theme_mod('ts_demo_importer_slide_two_image'.$i) != "" ) { ?>
                <img class="slide-back-img" src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_two_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_image_alt_text'.$i)); ?>" <?php if($i == 2 || $i == 3 || $i == 4){ ?> loading="lazy" <?php } ?>>
              <?php }
            }
            elseif(get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_video"){
              if ( get_theme_mod('ts_demo_importer_slide_vide_link'.$i,true) != "" ) {?>
                <video id="background-video" autoplay loop muted poster="">
                  <source src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_vide_link'.$i)); ?>" type="video/mp4">
                </video>
              <?php }
            } ?>
            <?php if ( get_theme_mod('ts_demo_importer_slide_two_left_girl_img'.$i) != "" || get_theme_mod('ts_demo_importer_slide_small_heading'.$i) != ""
                      || get_theme_mod('ts_demo_importer_slide_heading'.$i) != "" || get_theme_mod('ts_demo_importer_slide_text'.$i) != ""
                      || get_theme_mod('ts_demo_importer_slide_two_right_boy_img'.$i) != ""  ) {?>
              <div class="carousel-caption container">
                <div class="row">
                  <div class="col-4 slider-left-img">
                    <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_two_left_girl_img'.$i)); ?>" alt="">
                    <div class="left-purple-circle"></div>
                    <div class="left-green-circle"></div>
                  </div>
                  <div class="col-4">
                    <div class="slider-box">
                      <div class="" data-aos="zoom-in-left" data-aos-duration="2000">
                          <div class="inner_slide">
                            <span class="smalltext animated fadeInRight">
                              <?php echo get_theme_mod('ts_demo_importer_slide_small_heading'.$i); ?>
                            </span>
                            <h3 class="animated fadeInLeft"><?php echo esc_html(get_theme_mod('ts_demo_importer_slide_heading'.$i)); ?></h3>
                            <div class="animated fadeInRight slide_p"><?php echo get_theme_mod('ts_demo_importer_slide_text'.$i); ?></div>
                            <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i) != ''){ ?>
                              <a class="read-more animated fadeInLeft theme_button2 mr-4" href="<?php echo get_theme_mod('ts_demo_importer_slide_btn_one_url'.$i); ?>">
                                <?php echo get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i); ?>
                                <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i) != ''){ ?>
                                  <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i)); ?>"></i>
                                <?php } ?>
                              </a>
                            <?php } ?>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-4 slider-right-img">
                    <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_two_right_boy_img'.$i)); ?>" alt="">
                    <div class="right-purple-circle"></div>
                    <div class="right-green-circle"></div>
                  </div>
                </div>

                </div>
              <?php } ?>
            </div>
        <?php } ?>
      </div>
      <?php if ( get_theme_mod('ts_demo_importer_slider_arrows',true) == "1" ) { ?>
        <div class="slide_nav">
          <a class="carousel-prev-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
            <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
          </a>
          <a class="carousel-next-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
            <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
          </a>
        </div>
      <?php }?>

      <?php if ( get_theme_mod('ts_demo_importer_slider_dots',true) == "1" ) { ?>
      <div class="container custom_cls">
        <ol class="carousel-indicators">
          <?php for($i=1;$i<=$number;$i++){ ?>
            <li data-bs-target="#carouselindicators" data-bs-slide-to="<?php echo($i-1); ?>" class="<?php if($i==1){echo 'active';} ?>"></li>
          <?php } ?>
        </ol>
      </div>
    <?php } ?>
    </div>
      <!-- Slide 3 -->
  <?php } elseif ( $template == 'advance-consultancy' ) {  ?>
    <div id="carouselindicators" class="carousel slide <?php if ( get_theme_mod('ts_demo_importer_slide_remove_fade',true) == 1 ) { ?> carousel-fade <?php } ?>" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr($slide_delay); ?>">
      <div class="carousel-inner" role="listbox">
        <?php for ($i=1; $i<=$number; $i++) {  ?>
            <?php
              if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_gradient" ){

                $slide_color_1 = get_theme_mod('ts_demo_importer_slide_background_color_one'.$i);
                $slide_color_2 = get_theme_mod('ts_demo_importer_slide_background_color_two'.$i);

                $slide_gradient = 'background-image:linear-gradient(to right,'.esc_attr($slide_color_1).' , '.esc_attr($slide_color_2).');';

                $slide_height = 'height:'.esc_html(get_theme_mod('ts_demo_importer_slide_height'.$i)).'px;';
              }

            ?>

            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?> <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i) == "slide_type_gradient" ){ ?> style="<?php echo esc_attr($slide_gradient); ?><?php if($slide_height != ''){ echo esc_attr($slide_height); } ?>"
            <?php } ?>>

              <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_image" ){ ?>
                <?php if ( get_theme_mod('ts_demo_importer_slide_image'.$i) != "" ) { ?>
                  <img  src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_image_alt_text'.$i)); ?>" <?php if($i == 2 || $i == 3 || $i == 4){ ?> loading="lazy" <?php } ?>>
                <?php }
              }
              elseif(get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_video"){
                if ( get_theme_mod('ts_demo_importer_slide_vide_link'.$i,true) != "" ) {?>
                  <video id="background-video" autoplay loop muted poster="">
                    <source src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_vide_link'.$i)); ?>" type="video/mp4">
                  </video>
                <?php }
              } ?>

              <?php if ( get_theme_mod('ts_demo_importer_slide_heading'.$i) != "" || get_theme_mod('ts_demo_importer_slide_text'.$i) != "") {?>
                  <div class="carousel-caption d-md-block mt-5">
                    <div class="container h-100 position-relative">
                        <div class="inner_carousel">
                          <div class="slider-box">
                            <div class="" data-aos="zoom-in-left" data-aos-duration="2000">
                                <div class="inner_slide">
                                  <h3 class="animated fadeInLeft"><?php echo esc_html(get_theme_mod('ts_demo_importer_slide_heading'.$i)); ?></h3>
                                  <div class="animated fadeInRight slide_p"><?php echo get_theme_mod('ts_demo_importer_slide_text'.$i); ?></div>
                                  <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i) != ''){ ?>
                                    <a class="read-more animated fadeInLeft theme_button2 mr-4" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_url'.$i)); ?>">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i)); ?>
                                      <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i) != ''){ ?>
                                        <i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_slide_btn_one_icon'.$i)); ?>"></i>
                                      <?php } ?>
                                    </a>
                                  <?php } ?>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <?php if ( get_theme_mod('ts_demo_importer_slider_arrows',true) == "1" ) { ?>
                        <div class="slide_nav">
                          <a class="carousel-prev-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                            <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
                          </a>
                          <a class="carousel-next-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                            <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
                          </a>
                        </div>
                      <?php }?>
                  </div>
              <?php } ?>
            </div>
          <?php } ?>
      </div>

      <?php if ( get_theme_mod('ts_demo_importer_slider_dots',true) == "1" ) { ?>
        <div class="container custom_cls">
          <ol class="carousel-indicators">
            <?php for($i=1;$i<=$number;$i++){ ?>
              <li data-bs-target="#carouselindicators" data-bs-slide-to="<?php echo($i-1); ?>" class="<?php if($i==1){echo 'active';} ?>"></li>
            <?php } ?>
          </ol>
        </div>
      <?php } ?>
    </div>
    <?php // slider 4 START ?>
  <?php }elseif( $template == 'advance-training-academy' ){ ?>
    <div id="carouselindicators" class="carousel slide <?php if ( get_theme_mod('ts_demo_importer_slide_remove_fade',true) == 1 ) { ?> carousel-fade <?php } ?>" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr($slide_delay); ?>">
      <div class="carousel-inner" role="listbox">
        <?php for ($i=1; $i<=$number; $i++) {  ?>
            <?php
              if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_gradient" ){

                $slide_color_1 = get_theme_mod('ts_demo_importer_slide_background_color_one'.$i);
                $slide_color_2 = get_theme_mod('ts_demo_importer_slide_background_color_two'.$i);

                $slide_gradient = 'background-image:linear-gradient(to right,'.esc_attr($slide_color_1).' , '.esc_attr($slide_color_2).');';

                $slide_height = 'height:'.esc_html(get_theme_mod('ts_demo_importer_slide_height'.$i)).'px;';
              }

            ?>

            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?> <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i) == "slide_type_gradient" ){ ?> style="<?php echo esc_attr($slide_gradient); ?><?php if($slide_height != ''){ echo esc_attr($slide_height); } ?>"
            <?php } ?>>

              <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_image" ){ ?>
                <?php if ( get_theme_mod('ts_demo_importer_slide_image'.$i) != "" ) { ?>
                  <img  src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_image'.$i)); ?>" alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_image_alt_text'.$i)); ?>" <?php if($i == 2 || $i == 3 || $i == 4){ ?> loading="lazy" <?php } ?>>
                <?php }
              }
              elseif(get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_video"){
                if ( get_theme_mod('ts_demo_importer_slide_vide_link'.$i,true) != "" ) {?>
                  <video id="background-video" autoplay loop muted poster="">
                    <source src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_vide_link'.$i)); ?>" type="video/mp4">
                  </video>
                <?php }
              } ?>

              <?php if ( get_theme_mod('ts_demo_importer_slide_heading'.$i) != "" || get_theme_mod('ts_demo_importer_slide_text'.$i) != "") {?>
                  <div class="carousel-caption d-md-block">
                    <div class="container h-100 position-relative">
                      <div class="inner_carousel">
                        <div class="slider-box">
                          <div class="" data-aos="zoom-in-left" data-aos-duration="2000">
                              <div class="inner_slide">
                                <h3 class="slider-heading animated fadeInLeft">
                                  <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_heading'.$i)); ?>
                                </h3>
                                <p class="animated fadeInRight slide_p">
                                  <?php echo get_theme_mod('ts_demo_importer_slide_text'.$i); ?>
                                </p>
                                <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i) != ''){ ?>
                                  <a class="slider-button animated fadeInLeft theme_button2 mr-4" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_url'.$i)); ?>">
                                    <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i)); ?>
                                  </a>
                                <?php } ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php if ( get_theme_mod('ts_demo_importer_slider_arrows',true) == "1" ) { ?>
                        <div class="slide_nav">
                          <a class="carousel-prev-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                            <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
                          </a>
                          <a class="carousel-next-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                            <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
                          </a>
                        </div>
                      <?php }?>
                  </div>
              <?php } ?>
            </div>
          <?php } ?>
      </div>

      <?php if ( get_theme_mod('ts_demo_importer_slider_dots',true) == "1" ) { ?>
        <div class="container custom_cls">
          <div class="carousel-indicators">
            <?php for($j=1;$j<=$number;$j++){ ?>
               <button type="button"
                       data-bs-target="#carouselindicators"
                       data-bs-slide-to="<?php echo($j-1); ?>"
                       class=" <?php if ($j == 1) { echo 'active'; } ?>"
                       aria-current= "<?php if ($j == 1) { echo "true"; } ?>"
                       aria-label="Slide <?php echo $j; ?>">
               </button>
             <?php } ?>
           </div>
        </div>
      <?php } ?>
    </div>
    <?php // slider 4 END  ?>
  <?php }elseif( $template == 'ts-conference' ){ ?>
    <div id="carouselindicators" class="carousel slide <?php if ( get_theme_mod('ts_demo_importer_slide_remove_fade',true) == 1 ) { ?> carousel-fade <?php } ?>" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr($slide_delay); ?>">
      <div class="carousel-inner" role="listbox">
        <?php for ($i=1; $i<=1; $i++) {  ?>
            <?php
              if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_gradient" ){

                $slide_color_1 = get_theme_mod('ts_demo_importer_slide_background_color_one'.$i);
                $slide_color_2 = get_theme_mod('ts_demo_importer_slide_background_color_two'.$i);

                $slide_gradient = 'background-image:linear-gradient(to right,'.esc_attr($slide_color_1).' , '.esc_attr($slide_color_2).');';

                $slide_height = 'height:'.esc_html(get_theme_mod('ts_demo_importer_slide_height'.$i)).'px;';
              }

            ?>

            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?> <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i) == "slide_type_gradient" ){ ?> style="<?php echo esc_attr($slide_gradient); ?><?php if($slide_height != ''){ echo esc_attr($slide_height); } ?>"
            <?php } ?>>

              <?php if( get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_image" ){ ?>
                <?php if ( get_theme_mod('ts_demo_importer_slide_image'.$i) != "" ) { ?>
                  <img  src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_image'.$i)); ?>"
                        alt="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_image_alt_text'.$i)); ?>"
                        <?php if($i == 2 || $i == 3 || $i == 4){ ?> loading="lazy" <?php } ?>>
                <?php }
              }
              elseif(get_theme_mod('ts_demo_importer_slide_background_type'.$i,true) == "slide_type_video"){
                if ( get_theme_mod('ts_demo_importer_slide_vide_link'.$i,true) != "" ) {?>
                  <video id="background-video" autoplay loop muted poster="">
                    <source src="<?php echo esc_url(get_theme_mod('ts_demo_importer_slide_vide_link'.$i)); ?>" type="video/mp4">
                  </video>
                <?php }
              } ?>

              <?php if ( get_theme_mod('ts_demo_importer_slide_heading'.$i) != "" || get_theme_mod('ts_demo_importer_slide_text'.$i) != "") {?>
                  <div class="carousel-caption d-md-block">
                    <div class="container h-100 position-relative">
                      <div class="inner_carousel">
                        <div class="slider-box">
                          <div class="" data-aos="zoom-in-left" data-aos-duration="2000">
                              <div class="inner_slide">

                                <?php if ( get_theme_mod('ts_demo_importer_slide_small_heading'.$i) !='' ) { ?>
                                  <h6 class="slider-small-heading">
                                    <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_small_heading'.$i)); ?>
                                  </h6>
                                <?php } ?>

                                <?php if ( get_theme_mod('ts_demo_importer_slide_heading'.$i) !='' ) { ?>
                                  <h3 class="slider-heading animated fadeInLeft">
                                    <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_heading'.$i)); ?>
                                  </h3>
                                <?php } ?>

                                <?php if ( get_theme_mod('ts_demo_importer_slide_text'.$i) !='' ) { ?>
                                  <p class="slider-para animated fadeInRight slide_p">
                                    <?php echo get_theme_mod('ts_demo_importer_slide_text'.$i); ?>
                                  </p>
                                <?php } ?>

                                <div class="slider-btn-wrap d-flex justify-content-center g-2">
                                  <?php if( get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i) != ''){ ?>
                                    <a class="slider-button animated fadeInLeft d-block" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_url'.$i)); ?>">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_one_text'.$i)); ?>
                                    </a>
                                  <?php } ?>
                                  <?php if( get_theme_mod('ts_demo_importer_slide_btn_two_text'.$i) != ''){ ?>
                                    <a class="slider-button animated fadeInRight d-block" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_two_url'.$i)); ?>">
                                      <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_btn_two_text'.$i)); ?>
                                    </a>
                                  <?php } ?>
                                </div>

                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php } ?>
            </div>
          <?php } ?>

      </div>

      <?php if ( get_theme_mod('ts_demo_importer_slider_dots',true) == "1" ) { ?>
        <div class="container custom_cls">
          <div class="carousel-indicators">
            <?php for($j=1;$j<=$number;$j++){ ?>
               <button type="button"
                       data-bs-target="#carouselindicators"
                       data-bs-slide-to="<?php echo($j-1); ?>"
                       class=" <?php if ($j == 1) { echo 'active'; } ?>"
                       aria-current= "<?php if ($j == 1) { echo "true"; } ?>"
                       aria-label="Slide <?php echo $j; ?>">
               </button>
             <?php } ?>
           </div>
        </div>
      <?php } ?>

      <?php if ( get_theme_mod('ts_demo_importer_slider_arrows',true) == "1" ) { ?>
        <div class="slide_nav">
          <a class="carousel-prev-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-angle-left"></i></span>
            <span class="sr-only"><?php esc_html_e('Previous','ts-demo-importer'); ?></span>
          </a>
          <a class="carousel-next-button hvr-shrink" href="#carouselindicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-angle-right"></i></span>
            <span class="sr-only"><?php esc_html_e('Next','ts-demo-importer'); ?></span>
          </a>
        </div>
      <?php } ?>

    </div>

    <div class="below-slider-section">
      <div class="container">
        <?php if (get_theme_mod('ts_demo_importer_slide_below_heading') != '') { ?>
          <h3 class="slider-right-heading">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_slide_below_heading')); ?>
          </h3>
        <?php } ?>
      </div>
    </div>

  <?php } ?>

  </section>
<?php } ?>
