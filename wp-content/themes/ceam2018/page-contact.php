<?php get_header(); ?>

<?php if (get_full_image_src()) { ?>
<!--feature section-->
  <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">
    <div class="feature__container">
      <div class="feature__main">

        <?php include "src/svg/ceam-logo.php" ?>

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } else {?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2009/12/oldShed.jpg);">
    <div class="feature__container">
      <div class="feature__main">

        <?php include "src/svg/ceam-logo.php" ?>

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

      <div class="header__social">
        <a href="/support/donate" class="header__link donateBtn" class="donateBtn">Donate</a>
        <a href="<?php the_field('google_map_url', 'option'); ?>" class="header__link">Location</a>
        <a href="<?php the_field('phone_number', 'option'); ?>" class="header__link">Phone</a>

        <a href="<?php the_field('facebook_url', 'option'); ?>" class="header__icon">
          <div data-icon="ei-sc-facebook" data-size="m"></div>
        </a>

        <a href="<?php the_field('twitter_url', 'option'); ?>" class="header__icon">
          <div data-icon="ei-sc-twitter" data-size="m"></div>
        </a>

        <a href="<?php the_field('instagram_url', 'option'); ?>" class="header__icon">
          <div data-icon="ei-sc-instagram" data-size="m"></div>
        </a>

        <a href="<?php the_field('flickr_url', 'option'); ?>" class="header__icon">
          <div data-icon="ei-camera" data-size="m"></div>
        </a>
      </div>

    </div>

    <?php endwhile; endif; ?>

	</div>
</div>

<?php get_footer(); ?>
