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

    <?php if( have_rows('how_we_grow_it_page') ): while ( have_rows('how_we_grow_it_page') ) : the_row();

      //vars
      $title = get_sub_field('hwg_title');
      $text = get_sub_field('hwg_text');
      $image = get_sub_field('hwg_image');

    ?>

    <div class="grow__columns zipper">
      <div class="grow__pic setHeight" style="background-image: url(<?php echo $image; ?>);">

      </div>
      <div class="grow__content">
        <h2 class="grow__title"><?php echo $title; ?></h2>
        <p><?php echo $text; ?></p>
      </div>
    </div>

    <?php endwhile; else : endif; ?>

  </div>
</div>



<?php get_footer(); ?>
