<?php get_header(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_full_image_src()?>);">
  <div class="feature__container">
    <div class="feature__main">

      <?php include "svg/earthdance-logo.php" ?>

      <h1 class="feature__heading"><?php the_title( ); ?></h1>

    </div>
  </div>
</div>

<div class="page__layer">
	<div class="page__container">
      <div class="page__content-padding">
        <?php the_content();	?>
      </div>
	</div>
</div>

<div class="grow__layer">
  <div class="grow__container">

    <?php if( have_rows('seasonal_food_list') ): while ( have_rows('seasonal_food_list') ) : the_row();

      // vars
      $time = get_sub_field('time_of_year');
      $list = get_sub_field('list_of_food');

    ?>

    <div class="grow__content">
      <h2 class="grow__title"><?php echo $time; ?></h2>
      <div class="col3"><?php echo $list?></div>
    </div>

    <?php endwhile; else : endif; ?>

  </div>
</div>



<?php get_footer(); ?>
