<?php get_header(); ?>

<?php if (get_full_image_src()) { ?>
<!--feature section-->
  <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">
    <div class="feature__container">
      <div class="feature__main">

        <?php // include "src/svg/ceam-logo.php" ?>

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } else {?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2018/07/child-02.jpg);">
    <div class="feature__container">
      <div class="feature__main">

        <?php // include "src/svg/ceam-logo.php" ?>

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } ?>


<div class="page__layer">
	<div class="page__container">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="page__content">
      <?php the_content();	?>
    </div>

    <?php endwhile; endif; ?>

	</div>
</div>

<?php get_footer(); ?>
