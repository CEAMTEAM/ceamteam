<?php get_header(); ?>

<?php if (get_field( "board_photo" )) { ?>
<!--feature section-->
  <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">

    <div class="feature__container">
      <div class="feature__main">

        <?php include "svg/earthdance-logo.php" ?>

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } else {?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2009/12/oldShed.jpg);">
    <div class="feature__container">
      <div class="feature__main">

        <?php include "svg/earthdance-logo.php" ?>

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } ?>

<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <?php if ( get_field( "alumni_photo" ) ) { ?>
        <div class="bio-image" style="background-image: url(<?php echo get_field( "alumni_photo" ); ?>);"></div>
      <?php } ?>

      <?php echo get_field( "alumni_bio" ); ?>
    </div>
  </div>
</div>


<?php get_footer(); ?>
