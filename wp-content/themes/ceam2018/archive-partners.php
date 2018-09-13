<?php get_header(); ?>

<?php // Loop 1
$loop1 = new WP_Query(array(
  'post_type' => 'partners',
  'name' => 'landing-page'
)); // exclude category
while($loop1->have_posts()) : $loop1->the_post(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_field('partner_logo'); ?>);">
  <div class="feature__container">
    <div class="feature__main">

      <h1 class="feature__heading">Partners</h1>

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

<div class="page fogBg">
	<div class="page__container">
    <div class="page__content">

      <h2 class="page__headding">Mission Partners</h2>
      <?php echo term_description( '161', 'partner_types' ) ?>

      <div class="list__layer">

        <?php
        // Loop 2
        $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'partners' );
        $excludeLandingPage = $getLandingPage->ID;

        $args = array(
          'post_type' => 'partners',
          'post__not_in' => array($excludeLandingPage),
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'partner_types',
              'field'    => 'slug',
              'terms'    => 'mission-partners',
            ),
          ),
        );
        $loop2 = new WP_Query( $args );
        while($loop2->have_posts()) : $loop2->the_post(); ?>

        <div class="list__item">
          <div class="list__image" style="background-image: url(<?php echo get_field('partner_logo'); ?>);"></div>
          <div class="list__content">
            <h2 class="list__heading"><?php the_title()?></h2>
            <?php the_content(); ?>
          </div>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>

      </div>


      <h2 class="page__headding">Program Partners</h2>
      <?php echo term_description( '159', 'partner_types' ) ?>

      <div class="list__layer">

        <?php endwhile; wp_reset_postdata(); ?>

          <?php
          // Loop 2
          $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'partners' );
          $excludeLandingPage = $getLandingPage->ID;

          $args = array(
            'post_type' => 'partners',
            'post__not_in' => array($excludeLandingPage),
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'partner_types',
                'field'    => 'slug',
                'terms'    => 'programs-partners',
              ),
            ),
          );
          $loop2 = new WP_Query( $args );
          while($loop2->have_posts()) : $loop2->the_post(); ?>

          <div class="list__item">
            <div class="list__image" style="background-image: url(<?php echo get_field('partner_logo'); ?>);"></div>
            <div class="list__content">
              <h2 class="list__heading"><?php the_title()?></h2>
              <?php the_content(); ?>
            </div>
          </div>




        <?php endwhile; wp_reset_postdata(); ?>

      </div>

      <h2 class="page__headding">Resource Partners</h2>
      <?php echo term_description( '160', 'partner_types' ) ?>

      <div class="list__layer">

        <?php
        // Loop 2
        $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'partners' );
        $excludeLandingPage = $getLandingPage->ID;

        $args = array(
          'post_type' => 'partners',
          'post__not_in' => array($excludeLandingPage),
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'partner_types',
              'field'    => 'slug',
              'terms'    => 'resource-partners',
            ),
          ),
        );
        $loop2 = new WP_Query( $args );
        while($loop2->have_posts()) : $loop2->the_post(); ?>

        <div class="list__item">
          <div class="list__image" style="background-image: url(<?php echo get_field('partner_logo'); ?>);"></div>
          <div class="list__content">
            <h2 class="list__heading"><?php the_title()?></h2>
            <?php the_content(); ?>
          </div>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>

      </div>



      <h2 class="page__headding">Past Partners</h2>
      <?php echo term_description( '163', 'partner_types' ) ?>

      <div class="list__layer">

        <?php
        // Loop 2
        $getLandingPage = get_page_by_path( 'landing-page', OBJECT, 'partners' );
        $excludeLandingPage = $getLandingPage->ID;

        $args = array(
          'post_type' => 'partners',
          'post__not_in' => array($excludeLandingPage),
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'partner_types',
              'field'    => 'slug',
              'terms'    => 'past-partners',
            ),
          ),
        );
        $loop2 = new WP_Query( $args );
        while($loop2->have_posts()) : $loop2->the_post(); ?>

        <div class="list__item">
          <div class="list__image" style="background-image: url(<?php echo get_field('partner_logo'); ?>);"></div>
          <div class="list__content">
            <h2 class="list__heading"><?php the_title()?></h2>
            <?php the_content(); ?>
          </div>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>

      </div>
    </div>
  </div>
</div>



<?php get_footer(); ?>
