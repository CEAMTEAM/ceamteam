<?php get_header(); ?>

<!--feature section-->
<?php if (get_full_image_src()) { ?>
<!--feature section-->
  <div class="feature__layer" style="background-image: url(<?php echo get_full_image_src(); ?>);">
    <div class="feature__container">
      <div class="feature__main">

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } else {?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2018/07/child-02.jpg);">
    <div class="feature__container">
      <div class="feature__main">

        <h1 class="feature__heading"><?php the_title( ); ?></h1>

      </div>
    </div>
  </div>
<?php } ?>

<div class="page fogBg">
	<div class="page__container">
    <div class="page__content">

      <?php
        // Loop 2
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array('post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged);
        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();?>

        <div class="sideBySideGallery">
          <div class="frame-border">
            <div class="frame-inset" style="background-image: url(<?php echo get_full_image_src(); ?>);"></div>
          </div>
            
          <div class="sideBySideGallery__content">
            <h2 class="sideBySideGallery__heading"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
            <!-- <h3 class="sideBySideGallery__subheading"><?php echo get_field('board_career'); ?></h3> -->
          </div>
        </div>

      <?php endwhile; wp_reset_postdata(); ?>

      <?php wp_pagenavi( array( 'query' => $loop ) ); ?>
 
    </div>
  </div>
</div>

<?php get_footer(); ?>
