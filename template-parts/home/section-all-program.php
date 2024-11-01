<?php
   /**
    * Template part for All program
    *
    * @package ts-demo-importer
    */

   $section_hide = get_theme_mod( 'ts_demo_importer_all_program_enabledisable' );
   if ( 'Disable' == $section_hide ) {
    return;
   }

   if( get_theme_mod('ts_demo_importer_all_program_bgcolor','') ) {
    $program_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_all_program_bgcolor','')).';';
   }elseif( get_theme_mod('ts_demo_importer_all_program_bgimage','') ){
    $program_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_all_program_bgimage')).'\')';
   }else{
    $program_backg='';
   }

   if( get_theme_mod('ts_demo_importer_all_program_bg_att','fixed') ) {
    $program_backg_att = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_all_program_bg_att','')).';';
  }else {
    $program_backg_att = '';
  }


?>
<section id="all-program" style="<?php echo esc_attr($program_backg .';'.$program_backg_att);?>">
  <div class="container" data-aos="fade-up" data-aos-duration="2000">
    <div class="text-center">
      <?php if(get_theme_mod('ts_demo_importer_all_program_title') != ''){?>
        <h2 class="program-title mt-2">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_all_program_title')); ?>
        </h2>
      <?php } ?>
      <?php if (get_theme_mod('ts_demo_importer_all_program_paragraph') !=''){?>
        <p class="program-text">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_all_program_paragraph')); ?>
        </p>
      <?php } ?>
    </div>
    <div class="program-button mt-4 text-center">
      <?php if (get_theme_mod('ts_demo_importer_all_program_button_text') !=''){?>
        <a href="<?php echo esc_url(get_theme_mod('ts_demo_importer_all_program_button_url')); ?>">
          <?php echo esc_html(get_theme_mod('ts_demo_importer_all_program_button_text')); ?>
        </a>
      <?php }?>
    </div>
  </div>
</section>
