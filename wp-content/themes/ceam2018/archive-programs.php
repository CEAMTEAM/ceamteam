<?php get_header(); ?>

<?php // Loop 1
$loop1 = new WP_Query(array(
  'post_type' => 'programs',
  'name' => 'landing-page'
)); // exclude category
while($loop1->have_posts()) : $loop1->the_post(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_full_image_src()?>);">
  <div class="feature__container">
    <div class="feature__main">

      <h1 class="feature__heading">Farmers</h1>

    </div>
  </div>
</div>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">

      <?php the_content(); ?>

    </div>
  </div>
</div>

<?php endwhile; wp_reset_postdata(); ?>

<div class="grow__layer">
  <div class="grow__container">

    <?php
      // Loop 2
      $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'programs' );
      $excludeLandingPage = $getLandingPage->ID;

      $args = array(
        'post_type' => 'programs',
        'post__not_in' => array($excludeLandingPage, 14692),
        'posts_per_page' => -1,
        //'orderby'   => 'menu_order',
	      'order'     => 'ASC',
        'tax_query' => array(
          array(
            'taxonomy' => 'program_types',
            'field'    => 'slug',
            'terms'    => 'yeah',
            'operator' => 'NOT IN'
          ),
        ),
      );
      $loop2 = new WP_Query( $args );
      while($loop2->have_posts()) : $loop2->the_post(); ?>

      <div class="grow__columns zipper">
        <div class="grow__pic setHeight" style="background-image: url(<?php echo get_full_image_src(); ?>);">

        </div>
        <div class="grow__content">
          <h2 class="grow__title"><?php the_title(); ?></h2>
          <p><?php echo get_field( "program_teaser" ); ?></p>
          <p><a href="<?php the_permalink(); ?>" class="grow__button"><?php echo "Read more" ?></a></p>
        </div>
      </div>

    <?php endwhile; wp_reset_postdata(); ?>

  </div>
</div>


<?php get_footer(); ?>
