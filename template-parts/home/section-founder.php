<?php
   /**
    * Template part for founder
    *
    * @package ts-demo-importer
    */

   $section_hide = get_theme_mod( 'ts_demo_importer_founder_enabledisable' );
   if ( 'Disable' == $section_hide ) {
    return;
   }

   if( get_theme_mod('ts_demo_importer_founder_bgcolor_one','') || get_theme_mod('ts_demo_importer_founder_bgcolor_two', '') ) {
    // $founder_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_founder_bgcolor','')).';';
    $founder_backg = 'background: linear-gradient(to right, '.esc_attr(get_theme_mod('ts_demo_importer_founder_bgcolor_one')).' 1%, '.esc_attr(get_theme_mod('ts_demo_importer_founder_bgcolor_two')).' 0% 66%, #fff 66%);';
   }elseif( get_theme_mod('ts_demo_importer_founder_bgimage','') ){
    $founder_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_founder_bgimage')).'\')';
   }else{
    $founder_backg='';
   }

   if( get_theme_mod('ts_demo_importer_founder_bg_att','') ){
    $founder_backg_att = 'background-attachment:'.esc_attr(get_theme_mod('ts_demo_importer_founder_bg_att','')).';';
   }else{
    $founder_backg_att='';
   }

?>
<section id="founder" style="<?php echo esc_attr($founder_backg .';'.$founder_backg_att );?>" class="founder">
   <div class="container" data-aos="fade-up" data-aos-duration="2000">
      <div class="founder_inner_box">
         <div class="row align-items-center text-md-start text-center">
            <div class="col-md-8 founder-left-content"  data-aos="slide-right" data-aos-duration="2000">
               <?php if (get_theme_mod('ts_demo_importer_founder_small_title') !='') {?>
                  <span><?php echo esc_html(get_theme_mod('ts_demo_importer_founder_small_title')); ?></span>
               <?php } ?>
               <?php if (get_theme_mod('ts_demo_importer_founder_title') !='') {?>
                  <h2><?php echo esc_html(get_theme_mod('ts_demo_importer_founder_title')); ?></h2>
               <?php } ?>
               <?php if (get_theme_mod('ts_demo_importer_founder_text') !='') {?>
                  <p class="founder-text">
                    <?php echo esc_html(get_theme_mod('ts_demo_importer_founder_text')); ?>
                  </p>
               <?php } ?>
               <?php if (get_theme_mod('ts_demo_importer_founder_signature_image') !='') {?>
                  <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_founder_signature_image')); ?>" class="founder-sign">
               <?php } ?>
               <?php if (get_theme_mod('ts_demo_importer_founder_name') !='') {?>
                  <p class="founder-name-sign"><?php echo esc_html(get_theme_mod('ts_demo_importer_founder_name')); ?></p>
               <?php } ?>
            </div>
            <div class="col-md-4 right-box-content position-relative" data-aos="slide-left" data-aos-duration="2000">
               <?php if (get_theme_mod('ts_demo_importer_founder_image') !='') {?>
                  <img src="<?php echo esc_url(get_theme_mod('ts_demo_importer_founder_image')); ?>">
               <?php } ?>
               <div class="founder-right-box text-center">
                  <?php if (get_theme_mod('ts_demo_importer_founder_name') !='') {?>
                     <h3><?php echo esc_html(get_theme_mod('ts_demo_importer_founder_name')); ?></h3>
                  <?php } ?>
                  <?php if (get_theme_mod('ts_demo_importer_founder_designation') !='') {?>
                     <p>
                       <?php echo esc_html(get_theme_mod('ts_demo_importer_founder_designation')); ?>
                     </p>
                  <?php } ?>
               </div>

              <ul>
                <?php for ($i=0; $i <16 ; $i++) { ?>
                  <li></li>
                <?php } ?>
              </ul>

            </div>
         </div>
      </div>
   </div>
</section>
