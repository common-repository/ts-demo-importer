<?php
/*
Shortcodes
*/

// Achievements
function ts_demo_importer_achievements_shortcode( ){
  ob_start();
  	 include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-years-achievements.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-achievements', 'ts_demo_importer_achievements_shortcode' );

// Records
function ts_demo_importer_record_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-our-records.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-record', 'ts_demo_importer_record_shortcode' );

// Brand
function ts_demo_importer_brand_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-our-brands.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-brands', 'ts_demo_importer_brand_shortcode' );

// Our Vision
function ts_demo_importer_our_vision_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-our-vision.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-our-vision', 'ts_demo_importer_our_vision_shortcode' );

// Hiring Banner
function ts_demo_importer_hiring_banner_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-hiring-banner.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-hiring-banner', 'ts_demo_importer_hiring_banner_shortcode' );

// Business Skills
function ts_demo_importer_business_skills_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-business-skills.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-business-skills', 'ts_demo_importer_business_skills_shortcode' );

// Contact & Map
function ts_demo_importer_contact_map_shortcode( ){
  ob_start();
  	include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-contact-map.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-contact-map', 'ts_demo_importer_contact_map_shortcode' );

// Team
function ts_demo_importer_team_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-team.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-team', 'ts_demo_importer_team_shortcode' );

// Team video
function ts_demo_importer_team_video_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-our-team-video.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-team-video', 'ts_demo_importer_team_video_shortcode' );

// Team Block
function ts_demo_importer_team_block_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-team-block.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-team-block', 'ts_demo_importer_team_block_shortcode' );

// Single Team
function ts_demo_importer_single_team_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-single-team.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-single-team', 'ts_demo_importer_single_team_shortcode' );

// Projects Tab
function ts_demo_importer_our_projects_tab_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-our-projects-tab.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-our-projects-tab', 'ts_demo_importer_our_projects_tab_shortcode' );


// Hiring features
function ts_demo_importer_hiring_features_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-hiring-features.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-hiring-features', 'ts_demo_importer_hiring_features_shortcode' );

// hiring Roles
function ts_demo_importer_hiring_roles_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-hiring-roles.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-hiring-roles', 'ts_demo_importer_hiring_roles_shortcode' );

// hiring Contact
function ts_demo_importer_hiring_contact_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-hiring-contact.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-hiring-contact', 'ts_demo_importer_hiring_contact_shortcode' );

// Blog Page
function ts_demo_importer_latest_news_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-latest-news.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-latest-news', 'ts_demo_importer_latest_news_shortcode' );

//  advance-training-academy counter section shortcode
function ts_demo_importer_counter_section_shortcode( ){
  ob_start();
    include( plugin_dir_path(__DIR__ ) . 'template-parts/home/section-personalized-support.php' );
  return ob_get_clean();
}
add_shortcode( 'ts-demo-importer-counter', 'ts_demo_importer_counter_section_shortcode' );
