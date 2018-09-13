<?php get_header(); ?>

<?php // Loop 1
$loop1 = new WP_Query(array(
  'post_type' => 'cpt_testimonial',
  'name' => 'landing-page'
)); // exclude category
while($loop1->have_posts()) : $loop1->the_post(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_field('board_photo'); ?>);">
  <div class="feature__container">
    <div class="feature__main">

      <h1 class="feature__heading">Board of Directors</h1>

    </div>
  </div>
</div>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">

      <?php echo get_field('board_bio'); ?>

    </div>
  </div>
</div>

<div class="page fogBg">
	<div class="page__container">
    <div class="page__content">



        <?php endwhile; wp_reset_postdata(); ?>

          <?php
          // Loop 2
          $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'board' );
          $excludeLandingPage = $getLandingPage->ID;

          $args = array(
            'post_type' => 'cpt_testimonial',
            'post__not_in' => array($excludeLandingPage),
            'posts_per_page' => -1
          );
          $loop2 = new WP_Query( $args );
          while($loop2->have_posts()) : $loop2->the_post(); ?>

          <div class="sideBySideGallery">
            <div class="frame-border">
              <div class="frame-inset" style="background-image: url(<?php echo get_field( "board_photo" ); ?>);"></div>
            </div>
              
            <div class="sideBySideGallery__content">
              <h2 class="sideBySideGallery__heading"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
              <h3 class="sideBySideGallery__subheading"><?php echo get_field('board_career'); ?></h3>
            </div>
          </div>

        <?php endwhile; wp_reset_postdata(); ?>

 
    </div>
  </div>
</div>

<?php get_footer(); ?>
