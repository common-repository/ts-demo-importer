<?php
/**
 * Template part for displaying pricing plan
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_pricing_plan_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
   $img_bg = get_theme_mod('ts_demo_importer_pricing_plan_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_pricing_plan_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_pricing_plan_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_pricing_plan_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_pricing_plan_bgimage')).'\')';
  }else{
    $about_backg='';
  }

$template = wp_get_theme()->get( 'TextDomain' );
if($number != ''){

?>
<?php if ( $template == 'multi-advance' ) { ?>
<section id="pricing-plan" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="plan-head section_main_head text-center pt-3 head_center black_head" data-aos="zoom-in" data-aos-duration="2000">
      <?php if(get_theme_mod('ts_demo_importer_pricing_plan_small_heading')!=''){ ?>
        <small>
          <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_small_heading')); ?><span class="heading_border_style right_side"></span>
        </small>
      <?php } if(get_theme_mod('ts_demo_importer_pricing_plan_main_heading')!=''){ ?>
        <h3>
          <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_main_heading')); ?>
        </h3>
      <?php } ?>
    </div>
    <div class="">
      <div class="row plan_row position-relative" data-aos="zoom-in" data-aos-duration="2000">
        <?php
        $plan_count=get_theme_mod('ts_demo_importer_pricing_plan_number');
        for($i=1;$i<=$plan_count;$i++)
        {
        ?>
          <div class="col-lg-4 col-md-6 plan-info">
            <div class="plan-details mb-3">
              <div class="plan-icon">
                <?php if(get_theme_mod('ts_demo_importer_pricing_plan_icon'.$i)!=''){ ?>
                  <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_icon'.$i)); ?>"></i>
                <?php } ?>
              </div>
              <?php if(get_theme_mod('ts_demo_importer_pricing_plan_price'.$i)!=''){ ?>
                <div class="plan-price">
                  <div class="media">
                    <span class="plan_price d-flex align-self-center">
                      <sup><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_price_currency'.$i)); ?></sup><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_price'.$i)); ?>
                    </span>
                    <div class="media-body">
                      <?php if(get_theme_mod('ts_demo_importer_pricing_plan_duration'.$i)!=''){ ?>
                        <span class="plan_package">
                          <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_duration'.$i)); ?>
                        </span>
                      <?php } ?>
                      <?php if(get_theme_mod('ts_demo_importer_pricing_plan_title'.$i)!=''){ ?>
                        <h5>
                          <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_title'.$i)); ?>
                        </h5>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <?php $feature_count=get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i); ?>
              <div class="plan-features">
                <ul>
                  <?php for($j=1;$j<=$feature_count;$j++)
                  {
                  ?>
                    <?php if(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)!=''){ ?>
                      <li>
                        <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_icon')); ?>"></i><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)); ?>
                      </li>
                  <?php } } ?>
                </ul>
                <?php if(get_theme_mod('ts_demo_importer_pricing_plan_button_title'.$i)!=''){ ?>
                  <a class="theme_button2 mt-3" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_button_url'.$i)); ?>">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_button_title'.$i)); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_pricing_plan_button_icon'.$i)); ?>"></i>
                  </a>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="blank_bg"></div>
      </div>

    </div>

  </div>
</section>
<?php } elseif ( $template == 'advance-consultancy' ) { ?>
  <section id="pricing-plan" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
    <div class="container">
      <div class="plan-head section_main_head text-center pt-3 head_center black_head" data-aos="zoom-in" data-aos-duration="2000">
        <?php if(get_theme_mod('ts_demo_importer_pricing_plan_small_heading')!=''){ ?>
          <small>
            <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_small_heading')); ?><span class="heading_border_style right_side"></span>
          </small>
        <?php } if(get_theme_mod('ts_demo_importer_pricing_plan_main_heading')!=''){ ?>
          <h3>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_main_heading')); ?>
          </h3>
        <?php } ?>
      </div>
      <div class="row justify-content-center">
        <?php
            $plan_count=get_theme_mod('ts_demo_importer_pricing_plan_number');
            for($i=1;$i<=$plan_count;$i++)
            {
            ?>
        <div class="col-lg-4 col-md-6 col-sm-12 plan-box-content">
          <img class="recommeded-tag" src="/ts_demo_theme/wp-content/plugins/ts-demo-importer/assets/images/Start-up-Theme-Assets/Pricing-Plans/recommeded-tag.png" alt="">

          <div class="plan-box"  data-aos="zoom-in-down" data-aos-duration="2000">
              <?php if(get_theme_mod('ts_demo_importer_pricing_plan_title'.$i)!=''){ ?>
            <h3 class="plan-title">  <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_title'.$i)); ?> </h3>
              <?php } ?>

              <?php if(get_theme_mod('ts_demo_importer_pricing_plan_price'.$i)!=''){ ?>
            <h3 class="plan-price"><span><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_price_currency'.$i)); ?></span><?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_price'.$i)); ?></h3>
            <?php } ?>
            <?php $feature_count=get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i); ?>
              <?php for($j=1;$j<=$feature_count;$j++)
              {
              ?>
                <?php if(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)!=''){ ?>
                    <p class="feature-title feature-title<?php echo $j; ?>">
                      <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)); ?>
                    </p>
                    <div class="feature-title-border">
                    </div>
              <?php } } ?>

            <?php if(get_theme_mod('ts_demo_importer_pricing_plan_duration'.$i)!=''){ ?>
              <p class="plan_package">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_duration'.$i)); ?>
              </p>
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_pricing_plan_button_title'.$i)!=''){ ?>
              <a class="theme_white_btn mt-3" href="<?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_button_url'.$i)); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_button_title'.$i)); ?><i class="<?php echo esc_attr(get_theme_mod('ts_demo_importer_pricing_plan_button_icon'.$i)); ?>"></i>
              </a>
            <?php } ?>

          </div>
        </div>
      <?php } ?>
      </div>

    </div>
  </section>
<?php }elseif ( $template == 'ts-conference' ) { ?>
  <section id="pricing-plan" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
    <div class="container">
      <div class="section-titles pb-5 text-center"  data-aos="zoom-in" data-aos-duration="2000">
        <?php if (get_theme_mod('ts_demo_importer_pricing_plan_small_heading') != '') { ?>
          <h6 class="section-small-heading m-auto">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_small_heading')); ?>
          </h6>
        <?php } ?>

        <?php if (get_theme_mod('ts_demo_importer_pricing_plan_main_heading') != '') { ?>
          <h2 class="section-main-heading">
            <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_main_heading')); ?>
          </h2>
        <?php } ?>
      </div>

      <div class="owl-carousel">
        <?php $plan_count=get_theme_mod('ts_demo_importer_pricing_plan_number');
        for($i=1;$i<=$plan_count;$i++){ ?>
          <div class="pricing-plan-main-box" data-aos="zoom-in-down" data-aos-duration="2000">

            <?php if (get_theme_mod('ts_demo_importer_pricing_plan_feature_heading'.$i) != '') { ?>
              <span class="pricing-feature-head">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_heading'.$i)); ?>
              </span>
            <?php } ?>

            <?php if (get_theme_mod('ts_demo_importer_pricing_plan_price'.$i) != '') { ?>
              <h3 class="rate text-center pb-0 mt-4">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_price'.$i)); ?>
                <?php echo '/'; ?>
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_per_user'.$i)); ?>
              </h3>
            <?php } ?>

            <?php if (get_theme_mod('ts_demo_importer_pricing_plan_short_description'.$i) != '') { ?>
              <p class="pricing-plan-head text-center mb-4">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_short_description'.$i)); ?>
              </p>
            <?php } ?>

            <div class="features-text-container">
              <?php $feature_count=get_theme_mod('ts_demo_importer_pricing_plan_feature_no'.$i);
               for($j=1;$j<=$feature_count;$j++) {
                 if(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)!=''){ ?>
                   <p class="feature-title">
                     <i class="<?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_title_icon')) ?>"></i>
                     <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_feature_title'.$i.$j)); ?>
                   </p>
                 <?php }
               } ?>
            </div>

            <?php if (get_theme_mod('ts_demo_importer_pricing_plan_get_started_btn'.$i) != '') { ?>
              <a class="section-btn d-block text-center mt-3" href="<?php echo esc_url(get_theme_mod('ts_demo_importer_pricing_plan_get_started_btn_url'.$i)); ?>">
                <?php echo esc_html(get_theme_mod('ts_demo_importer_pricing_plan_get_started_btn'.$i)); ?>
              </a>
            <?php } ?>

          </div>
        <?php } ?>
      </div>

    </div>
  </section>
  <?php } ?>
<?php } ?>
