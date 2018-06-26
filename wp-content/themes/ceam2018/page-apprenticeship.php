<?php get_header(); ?>

<!--feature section-->
<div class="feature__layer" style="background-image: url(<?php echo get_full_image_src()?>);">
  <div class="feature__container">
    <div class="feature__main">

      <?php include "src/svg/ceam-logo.php" ?>

      <h1 class="feature__heading"><?php the_title( ); ?></h1>

    </div>
  </div>
</div>

<div class="page__layer">
	<div class="page__container">
      <div class="page__content-padding">
        <?php echo get_field("apprentice_intro");	?>
      </div>
	</div>
</div>

<div class="grow__layer">
  <div class="grow__container">

    <?php if( have_rows('apprentice_duties') ): while ( have_rows('apprentice_duties') ) : the_row();

      // vars
      $image = get_sub_field('duty_image');
      $title = get_sub_field('duty_title');
      $description = get_sub_field('duty_description');
    ?>

    <div class="grow__columns zipper">
      <div class="grow__pic setHeight" style="background-image: url(<?php echo $image; ?>);"></div>
      <div class="grow__content">
        <h2 class="grow__title"><?php echo $title; ?></h2>
        <p><?php echo $description?></p>
      </div>
    </div>

    <?php endwhile; else : endif; ?>

  </div>
</div>

<div class="page__layer">
	<div class="page__container">
    <div class="page__content-padding">
      <?php echo get_field("apprentice_details");	?>
      </div>
	</div>
</div>

  <!--stats section-->
  <div class="stats__layer">
    <div class="stats__container">
      <h2 class="stats__heading"><?php echo get_field( "stats_heading" ); ?></h2>
      <div class="stats__content"><?php echo get_field( "stats_description" ); ?></div>
      <div class="stats__columns">

        <?php if( have_rows('apprentice_faq') ): while ( have_rows('apprentice_faq') ) : the_row();

          // vars
          $question = get_sub_field('faq_question');
          $answer = get_sub_field('faq_answer');

        ?>

  			<div class="stats__item">
  				<h3 class="stats__number"><?php echo $question ?></h3>
  				<div class="stats__content">
  					<p><?php echo $answer ?></p>
  				</div>
  			</div>

        <?php endwhile; else : endif; ?>

  		</div>
    </div>
  </div>



<div class="grow__layer">
  <div class="grow__container">

    <?php if( have_rows('apprentice_testimonials') ): while ( have_rows('apprentice_testimonials') ) : the_row();

      // vars
      $image = get_sub_field('testimonial_image');
      $quote = get_sub_field('testimonial_quote');
      $name = get_sub_field('testimonial_name');
      $year = get_sub_field('testimonial_year');
    ?>

    <div class="grow__columns zipper">
      <div class="grow__pic setHeight" style="background-image: url(<?php echo $image; ?>);"></div>
      <div class="grow__content">
        <h2 class="grow__title"><?php echo $name; ?> class of <?php echo $year; ?></h2>
        <p><?php echo $quote?></p>
      </div>
    </div>

    <?php endwhile; else : endif; ?>

  </div>
</div>

<div class="page__layer">
	<div class="page__container">

      <div class="page__content-padding">
        <?php echo get_field("apprentice_application");	?>
      </div>

	</div>
</div>


<?php get_footer(); ?>
