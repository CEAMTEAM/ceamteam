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

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2018/07/child-02.jpg);">
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
    </div>

    <?php endwhile; endif; ?>



    <!--grow section-->
    <div class="grow__layer">
      <h2 class="grow__heading"><?php echo get_field( "Lead_in_heading" ); ?></h2>
      <div class="grow__container">
        <?php if( have_rows('lead_in_items') ): while ( have_rows('lead_in_items') ) : the_row();

          // vars
          $image = get_sub_field('image');
          $heading = get_sub_field('heading');
          $text = get_sub_field('content');
          $url = get_sub_field('button_url');
          $urlText = get_sub_field('button_text');
        ?>

          <div class="grow__columns zipper">
            <div class="grow__pic" style="background-image: url(<?php echo $image?>);"></div>
            <div class="grow__content">
              <h3 class="grow__subheading"><?php echo $heading ?></h3>
              <div class="grow__text">
                <?php echo $text ?>
              </div>
              <p><a href="<?php echo $url ?>" class="grow__button"><?php echo $urlText ?></a></p>
            </div>
          </div>

        <?php endwhile; else : endif; ?>

      </div>
    </div>

	</div>
</div>

<?php get_footer(); ?>
