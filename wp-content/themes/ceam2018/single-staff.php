<?php get_header(); ?>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h2 class="content__heading"><?php the_title()?></h2>
      <h3 class="content__subheading"><?php echo get_field('staff_title'); ?></h3>
      <?php echo get_field( "staff_bio" ); ?>
      <div class="frame-border">
        <div class="frame-inset" style="background-image: url(<?php echo get_field( "staff_photo" ); ?>);"></div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
