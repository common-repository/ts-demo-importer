<?php
/**
 * Template part for displaying Contact Us
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_contact_map_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
$template = wp_get_theme()->get( 'TextDomain' );

?>
<section id="contact-us" class="position-relative p-0">
  <?php if ($template == 'multi-advance'){ ?>
    <div class="google-map text-center p-0" id="map">
      <?php if ( get_theme_mod('ts_demo_importer_contact_map_latitude') != "" && get_theme_mod('ts_demo_importer_contact_map_longitude') != "" ) {?>
        <embed width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo esc_attr(get_theme_mod('ts_demo_importer_contact_map_latitude')); ?>,<?php echo esc_attr(get_theme_mod('ts_demo_importer_contact_map_longitude')); ?>&hl=es;z=14&amp;output=embed"></embed>
      <?php }?>
    </div>
    <div class="container position-relative">
      <div class="contact_block_outer d-flex align-items-center">
        <div class="contact_block">
          <div class="section_main_head pt-3 pb-2 black_head" data-aos="zoom-in-up" data-aos-duration="2000">
            <?php if(get_theme_mod('ts_demo_importer_contact_map_small_heading')!=''){ ?>
              <small>
                <span class="heading_border_style"></span><?php echo esc_html(get_theme_mod('ts_demo_importer_contact_map_small_heading')); ?>
              </small>
            <?php } if(get_theme_mod('ts_demo_importer_contact_map_main_heading')!=''){ ?>
              <h3>
                <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_map_main_heading')); ?>
              </h3>
            <?php } ?>

            <?php if(get_theme_mod('ts_demo_importer_contact_map_shortcode')!=''){ ?>
            <div class="contact_column_2">
              <div class="contact-shortcode">
                <?php echo do_shortcode(get_theme_mod('ts_demo_importer_contact_map_shortcode')); ?>
              </div>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php }elseif($template == 'ts-conference'){ ?>
    <div class="container position-relative">
      <?php if ( get_theme_mod('ts_demo_importer_contact_map_latitude') != "" && get_theme_mod('ts_demo_importer_contact_map_longitude') != "" ) { ?>
        <embed
            width="100%"
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
            src="https://maps.google.com/maps?q=<?php echo esc_attr(get_theme_mod('ts_demo_importer_contact_map_latitude')); ?>,
                                                <?php echo esc_attr(get_theme_mod('ts_demo_importer_contact_map_longitude')); ?>&hl=es;z=14&amp;output=embed">
        </embed>
      <?php }?>
      <div class="map-form">
        <?php if (get_theme_mod('ts_demo_importer_contact_map_main_heading') !=''){ ?>
          <h2>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_map_main_heading')); ?>
          </h2>
        <?php } ?>

        <?php if (get_theme_mod('ts_demo_importer_contact_map_description') !=''){ ?>
          <p>
            <?php echo esc_html(get_theme_mod('ts_demo_importer_contact_map_description')); ?>
          </p>
        <?php } ?>

        <?php if(get_theme_mod('ts_demo_importer_contact_map_shortcode')!=''){ ?>
          <div class="contact-shortcode">
            <?php echo do_shortcode(get_theme_mod('ts_demo_importer_contact_map_shortcode')); ?>
          </div>
        <?php } ?>

      </div>
    </div>
  <?php } ?>
</section>
