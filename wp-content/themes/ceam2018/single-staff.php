<?php get_header(); ?>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h2 class="content__heading"><?php the_title()?></h2>
      <h3 class="content__subheading"><?php echo get_field('staff_title'); ?></h3>
      <div class="content">
        <?php echo get_field( "staff_bio" ); ?>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
