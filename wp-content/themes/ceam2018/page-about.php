<?php get_header(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">
  <div class="feature__container">
    <div class="feature__main">

      <h1 class="feature__heading"><?php the_title(); ?></h1>

    </div>
  </div>
</div>

<div class="page__layer">
  <div class="page__container">
    <div class="page__content">
      <div class=""><?php echo get_field( "intro_text" ); ?></div>
    </div>
  </div>
</div>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php if( have_rows('about_sections') ): while ( have_rows('about_sections') ) : the_row();
        // vars
        $image = get_sub_field('section_image');
        $heading = get_sub_field('section_headings');
        $content = get_sub_field('section_content');
      ?>

      <div class="feature__layer" style="background-image: url(<?php echo $image?>);">
        <div class="feature__container">
          <div class="feature__main">
            <h3 class="feature__heading"><?php echo $heading ?></h3>
          </div>
        </div>
      </div>

      <div class="page__layer">
        <div class="page__container">
          <div class="page__content">
            <?php echo $content ?>
          </div>
        </div>
      </div>

<?php endwhile; endif;  wp_reset_postdata(); ?>


<?php // Loop 1
  $loop1 = new WP_Query(array(
    'post_type' => 'programs',
    'name' => 'landing-page'
  )); // exclude category

  while($loop1->have_posts()) : $loop1->the_post(); ?>

    <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">
      <div class="feature__container">
        <div class="feature__main">

          <?php include "svg/earthdance-logo.php" ?>

          <h1 class="feature__heading">Programs</h1>

        </div>
      </div>
    </div>

  <?php endwhile; ?>

  <div class="grow__layer padding-top-4-rem">
    <div class="grow__container">

      <?php
        // Loop 2
        $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'programs' );
        $excludeLandingPage = $getLandingPage->ID;

        $args = array(
          'post_type' => 'programs',
          'post__not_in' => array($excludeLandingPage, 14692),
          'posts_per_page' => -1,
          //'orderby' => 'menu_order',
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


<?php endwhile; endif; ?>

<?php get_footer(); ?>
