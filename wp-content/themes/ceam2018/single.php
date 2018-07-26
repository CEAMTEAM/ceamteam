<?php get_header(); ?>

<?php if (get_full_image_src()) { ?>
<!--feature section-->
  <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);"></div>
<?php } else {?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2018/07/child-02.jpg);"></div>
<?php } ?>
  
<div class="page">
	<div class="page__container">
    <div class="page__content-padding">
      <h1 class="post__heading"><?php the_title( ); ?></h1>

      <?php the_content(); ?>

    </div>
  </div>
</div>


<?php get_footer(); ?>
