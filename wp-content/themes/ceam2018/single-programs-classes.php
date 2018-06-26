<?php get_header(); ?>

<?php // Loop 1
$loop1 = new WP_Query(array(
  'post_type' => 'classes',
  'name' => 'landing-page'
)); // exclude category
while($loop1->have_posts()) : $loop1->the_post(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_full_image_src()?>);">
  <div class="feature__container">
    <div class="feature__main">

      <?php include "svg/earthdance-logo.php" ?>

      <h1 class="feature__heading">Classes</h1>

    </div>
  </div>
</div>

<div class="page">
	<div class="page__container">
    <div class="page__content">

      <?php echo get_field( "class_description" ); ?>

    </div>
  </div>
</div>

<?php endwhile; wp_reset_postdata(); ?>

  <div class="grow__layer padding-top-4-rem">
    <div class="grow__container">

      <?php
        $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'classes' );
        $excludeLandingPage = $getLandingPage->ID;

        $args = array(
          'post_type' => 'classes',
          'post__not_in' => array($excludeLandingPage),
          'posts_per_page' => -1
        );

        $loop2 = new WP_Query( $args );
        while($loop2->have_posts()) : $loop2->the_post(); ?>

        <div class="grow__columns zipper">
          <div class="grow__pic setHeight" style="background-image: url(<?php echo get_full_image_src();?>)">

          </div>
          <div class="grow__content">
            <h2 class="grow__title"><?php echo get_field( "class_date" ); ?> - <?php the_title();  ?></h2>
            <p><?php echo get_field( "class_description" ); ?></p>
            <!-- <p><a href="<?php //the_permalink(); ?>" class="grow__button"><?php //echo "Read more" ?></a></p> -->
          </div>
        </div>

      <?php endwhile; wp_reset_postdata(); ?>

    </div>
  </div>


<?php get_footer(); ?>
