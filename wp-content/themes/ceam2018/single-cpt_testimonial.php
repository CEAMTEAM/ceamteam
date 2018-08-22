<?php get_header(); ?>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h2 class="content__heading"><?php the_title()?></h2>
      <h3 class="content__subheading"><?php the_excerpt()?></h3>
      <?php the_content() ?>
      <div class="frame-border">
        <div class="frame-inset" style="background-image: url(<?php echo get_full_image_src(); ?>);"></div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
