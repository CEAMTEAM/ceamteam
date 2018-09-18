<?php get_header(); ?>


<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h2 class="content__heading"><?php the_title()?></h2>
      <!-- <div class="feature__layer" style="background-image: url(<?php //echo get_full_image_src(); ?>);"></div> -->
      <?php if (have_posts()) : while (have_posts()) : the_post();?>

      <!-- <p class="gray italics thin"><?php // the_time('M j, Y '); ?> </p> -->

      <div class="content">
        <?php the_content() ?>
      </div>

      <?php endwhile; endif; ?>


      <div>
        <p id="prev" class="p"> &laquo; Previous Post: <?php previous_post_link('%link'); ?></p>
        <p id="next" class="p"> &raquo; Next Post: <?php next_post_link('%link'); ?></p>
      </div>
    </div>
    
  </div>
</div>

<?php get_footer(); ?>

