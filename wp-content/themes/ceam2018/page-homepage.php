<?php get_header(); ?>
<h1>hello</h1>
<?php
  $args = array(
    'post_type' => 'homepage',
    'posts_per_page' => 1
  );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <!--feature section-->
  <div class="feature__layer">

    <div class="crossfade" style="background-image: url(<?php echo get_field( "featured_image" ); ?>)"></div>
    <!-- 
    <div class="crossfade" style="background-image: url(<?php echo get_field( "featured_image_2" ); ?>)"></div>
    <div class="crossfade" style="background-image: url(<?php echo get_field( "featured_image_3" ); ?>)"></div> 
    -->

    <div class="feature__container">
      <div class="feature__main">

        <h1 class="feature__heading"><?php echo get_field( "featured_text" ); ?></h1>
        <p>
          <a class="feature__button" href="<?php echo get_field( "featured_button_text" ); ?>">
            <?php echo get_field( "featured_button_text" ); ?>
          </a>
        </p>

      </div>
    </div>

  </div>

  <!--grow section-->
  <div class="grow__layer">
    <h2 class="grow__heading"><?php echo get_field( "Lead_in_heading" ); ?></h2>
    <div class="grow__container">
      <?php if( have_rows('lead_in_items') ): while ( have_rows('lead_in_items') ) : the_row();

        // vars
    		$image = get_sub_field('image');
        $heading = get_sub_field('heading');
    		$text = get_sub_field('content');
    		$url = get_sub_field('button_url');
        $urlText = get_sub_field('button_text');
      ?>

        <div class="grow__columns zipper">
          <div class="grow__pic" style="background-image: url(<?php echo $image?>);"></div>
          <div class="grow__content">
            <h3 class="grow__subheading"><?php echo $heading ?></h3>
            <div class="grow__text">
              <?php echo $text ?>
            </div>
            <p><a href="<?php echo $url ?>" class="grow__button"><?php echo $urlText ?></a></p>
          </div>
        </div>

      <?php endwhile; else : endif; ?>

    </div>
  </div>

  <!-- video section -->
  <div class="video__layer">
    <div class="video__feature">
      <h2 class="video__heading"><?php echo get_field( "video_heading" ); ?></h2>
      <div class="responsive-video-embed">
        <?php echo get_field( "video_embed" ); ?>
      </div>
    </div>
  </div>

  <div class="gallery__layer bgGrape">
    <h2 class="gallery__heading"><?php echo get_field( "get_involved_heading" ); ?></h2>
    <div class="galler__container">
      <div class="gallery__wrapper">

        <?php if( have_rows('get_involved_items') ): while ( have_rows('get_involved_items') ) : the_row();

          // vars
          $image = get_sub_field('image');
          $heading = get_sub_field('heading');
          $text = get_sub_field('content');
          $url = get_sub_field('button_url');
          $urlText = get_sub_field('button_text');
        ?>

        <div class="gallery__item">
          <a href="<?php echo $url ?>" class="gallery__button" style="background-image: url(<?php echo $image; ?>);">
            <span><?php echo $heading?>
          </span>
          </a>
        </div>

        <?php endwhile; else : endif; ?>
      </div>
    </div>
  </div>


<?php endwhile;?>

<?php get_footer(); ?>
