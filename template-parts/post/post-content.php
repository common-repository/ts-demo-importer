<?php

$content_type = get_theme_mod( 'ts_demo_importer_post_content_blog','Excerpt Content');
  $excerpt_length="";
  if($content_type == "Excerpt Content"){
    $excerpt_length=get_theme_mod( 'ts_demo_importer_excerpt_length',15);
  }



?>
  <div class="latest-main-box wow zoomInDown delay-1000 animated" data-wow-duration="2s">
    <?php if (has_post_thumbnail()){ ?>
      <?php the_post_thumbnail(); ?>
    <?php } ?>
    <div class="postbox-content">
      <div class="mt-2">
        <span class="entry-date">
          <i class="fa-solid fa-calendar me-1"></i>
          <?php the_time( 'd M Y' ) ?>
        </span>
        <span class="latest-author ms-2">
          <i class="fa-solid fa-user me-1"></i>
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php the_author(); ?>
          </a>
        </span>
      </div>
      <h3 class="latest-post-title p-0">
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </h3>
      <div class="news-text mt-3">
        <?php $excerpt = get_the_excerpt(); echo esc_html(ts_demo_importer_string_limit_words($excerpt,$excerpt_length)); ?>
      </div>
      <div class="readmore_comment_link mt-4 pt-2">
        <div class="row align-items-center m-0">
          <div class="col-lg-5 col-md-5 col-6 ps-0 pe-0">
            <?php if(get_theme_mod('ts_demo_importer_latest_news_read_more_text')!=''){ ?>
              <a class="blog_read_more" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('ts_demo_importer_latest_news_read_more_text')); ?>
              </a>
            <?php } ?>
          </div>
          <div class="col-lg-7 col-md-7 col-6 pe-0 ps-0">
            <div class="comment_link d-flex justify-content-end">
              <?php echo do_shortcode('[posts_like_dislike id='.get_the_ID().']');?><span class="post-like-text">Like</span>
              <span class="entry-comments"><i class="fas fa-comments me-1"></i><?php comments_number( 'Comment 0', 'Comment 1', 'Comments % ' ); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
