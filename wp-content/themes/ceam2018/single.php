<?php get_header(); ?>


<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h2 class="content__heading"><?php the_title()?></h2>
      <!-- <div class="feature__layer" style="background-image: url(<?php //echo get_full_image_src(); ?>);"></div> -->
      <?php the_content() ?>
    </div>
  </div>
</div>
  

<?php get_footer(); ?>
