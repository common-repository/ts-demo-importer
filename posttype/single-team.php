<?php
/**
 * The Template for displaying all single teachers.
 *
 * @package multi-advance
 */
get_header();
include( plugin_dir_path(__DIR__ ) . '/page-banner/banner.php' );
?>
<div class="container mt-4">
    <div id="single-team">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-7 col-sm-12 col-lg-8 col-xs-12">
                    <div class="inner-page-feature-box"> 
                        <img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="<?php the_title(); ?> post thumbnail">
                        <div class="team_details">
                            <?php if(get_post_meta($post->ID,'meta-designation',true)) { ?>
                                <span>
                                    <i class="fas fa-user"></i>
                                    <?php echo esc_html(get_post_meta($post->ID,'meta-designation',true)); ?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID,'meta-team-email',true)) { ?>
                                <span class="email">
                                    <i class="far fa-envelope"></i>
                                    <?php echo esc_html(get_post_meta($post->ID,'meta-team-email',true)); ?>
                                </span>
                            <?php } if(get_post_meta($post->ID,'meta-team-phone',true)) { ?>
                                <span class="phone">
                                    <i class="fas fa-phone"></i>
                                    <?php echo esc_html(get_post_meta($post->ID,'meta-team-phone',true)); ?>
                                </span>
                            <?php } ?>
                        </div>
                        <div class="social-profiles">
                            <?php if(get_post_meta($post->ID,'meta-tfacebookurl',true)) { ?>
                                <a class="" href="<?php echo esc_html(get_post_meta($post->ID,'meta-tfacebookurl',true)); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                             <?php }
                            if(get_post_meta($post->ID,'meta-ttwitterurl',true)) { ?>
                                <a class="" href="<?php echo esc_html(get_post_meta($post->ID,'meta-ttwitterurl',true)); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <?php }
                            if(get_post_meta($post->ID,'meta-tlinkdenurl',true)) { ?>
                                 <a class="" href="<?php echo esc_html(get_post_meta($post->ID,'meta-tlinkdenurl',true)); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <?php } 
                                if(get_post_meta($post->ID,'meta-tinstagram',true)!= ''){ ?>
                                <a href="<?php echo esc_html(get_post_meta($post->ID,'meta-tinstagram',true)); ?>">
                                    <i class="fab fa-instagram align-middle" aria-hidden="true"></i>
                                </a>
                            <?php } if(get_post_meta($post->ID,'meta-pinterest',true)!= ''){ ?>
                                <a href="<?php echo esc_html(get_post_meta($post->ID,'meta-pinterest',true)); ?>">
                                    <i class="fab fa-pinterest-p align-middle "></i><span class="screen-reader-text"><?php echo esc_html('pinterest', 'digital-agency-pro-plugin' ) ; ?></span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="single-page-content"><?php the_content();?></div>
                </div>
                <div class="col-md-5 col-sm-12 col-lg-4 col-xs-12" id="sidebar">
                  <?php dynamic_sidebar('sidebar-1'); ?>
                </div>
            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php get_footer(); ?>