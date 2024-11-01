<?php
/**
 * Template part for displaying our projects Tab
 *
 * @package ts-demo-importer
 */

  $section_hide = get_theme_mod( 'ts_demo_importer_our_projects_tab_enable' );
  if ( 'Disable' == $section_hide ) {
    return;
  }
  $img_bg = get_theme_mod('ts_demo_importer_our_projects_tab_bgimage_setting');
  if( get_theme_mod('ts_demo_importer_our_projects_tab_bgcolor','') ) {
    $about_backg = 'background-color:'.esc_attr(get_theme_mod('ts_demo_importer_our_projects_tab_bgcolor','')).';';
  }elseif( get_theme_mod('ts_demo_importer_our_projects_tab_bgimage','') ){
    $about_backg = 'background-image:url(\''.esc_url(get_theme_mod('ts_demo_importer_our_projects_tab_bgimage')).'\')';
  }else{
    $about_backg='';
  }
?>
<section id="our-projects-tab" style="<?php echo esc_attr($about_backg); ?>" class="<?php echo esc_attr($img_bg); ?>">
  <div class="container">
    <div class="section_main_head text-left pt-3 pb-4 black_head" data-aos="fade-up" data-aos-duration="3000">
      <div class="row">
        <div class="col-md-6">
          <?php if(get_theme_mod('ts_demo_importer_our_projects_tab_small_heading')!=''){ ?>
            <small>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_tab_small_heading')); ?><span class="heading_border_style right_side"></span>
            </small>
          <?php } if(get_theme_mod('ts_demo_importer_our_projects_tab_main_heading')!=''){ ?>
            <h3>
              <?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_tab_main_heading')); ?>
            </h3>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <?php if(get_theme_mod('ts_demo_importer_our_projects_tab_text')!=''){ ?>
            <div class="section_text">
              <?php echo get_theme_mod('ts_demo_importer_our_projects_tab_text'); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>



      <?php  $tab_no = get_theme_mod('ts_demo_importer_our_projects_tab_number'); ?>

      <ul class="nav nav-tabs nav-justified class-categories text-right" role="tablist">
        <?php for($f=1; $f<=$tab_no; $f++) {
        ?>
          <li class="nav-item cat<?php echo($f); ?>">
            <a class="nav-link <?php if($f==1){ echo 'active'; } ?>" href="javascript:void(0)" role="tab" data-bs-toggle="tab" data-bs-target="#project_tab<?php echo esc_attr($f);?>" role="tab" aria-controls="project_tab<?php echo esc_attr($f);?>" aria-selected="true">
              <?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_tab_name'.$f)); ?>
            </a>
          </li>
        <?php } ?>
      </ul>

      <div class="tab-content project_row">

        <?php  $tab_no = get_theme_mod('ts_demo_importer_our_projects_tab_number'); ?>

        <?php for($j=1; $j<=$tab_no; $j++) {

          $category_name = get_theme_mod('ts_demo_importer_our_projects_tab_categoryselection_setting'.$j);
        ?>
        <div role="tabpanel" class="tab-pane <?php if($j == 1){echo 'active';} ?> <?php echo $category_name; ?>" id="project_tab<?php echo esc_attr($j);?>">
          <div class="row">
            <?php
            $args = array(
              'post_type' => 'projects',
              'projectscategory'=> get_theme_mod('ts_demo_importer_our_projects_tab_categoryselection_setting'.$j),
              'posts_per_page' => -1
            );
            $query = new WP_Query($args);
            $k = 1;
            while ($query->have_posts()) : $query->the_post();
            ?>

            <?php if($k == 1){?><div class="row m-0 p-0"><?php } ?>

            <?php if($k == 10){?><div class="row m-0 p-0"><div class="col-md-6"><div class="row"><?php } ?>
              <div class="project_auther <?php if($k == 1 || $k == 2 || $k == 3 || $k == 4 || $k == 5 || $k == 10 || $k == 11 || $k == 12 || $k == 13 || $k == 14){echo 'col-lg-6';} else{echo 'col-lg-3';} ?> col-md-6 box mb-3">
                <div class="project_images">
                  <?php the_post_thumbnail() ?>
                  <div class="project-sec">
                    <div class="project-box"><h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                      <?php if(get_post_meta(get_the_ID(),'meta-projects-type',true)) { ?>
                        <span class="short_title1">
                          <?php echo esc_html(get_post_meta(get_the_ID(),'meta-projects-type',true)); ?>
                        </span>
                      <?php } ?>
                      <a class="project_link" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_our_projects_tab_box_link_text')); ?></a>
                    </div>
                  </div>
                </div>
              </div>

            <?php if($k == 13){?></div></div><?php } ?>
            <?php if($k == 1){?><div class="col-md-6"><div class="row"><?php } ?>
            <?php if($k == 5){?></div></div></div> <?php } ?>
            <?php if($k == 14){?></div> <?php } ?>
            <?php $k++; endwhile;  ?>
          </div>
        </div>
        <?php } ?>
      </div>

  </div>
</section>
