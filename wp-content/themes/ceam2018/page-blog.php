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

<div class="news__layer">
  <div class="news__container">
    <div class="page__content">


      <?php
        // Example for adding WP PageNavi to a new WP_Query call
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array('post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged);
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();?>

          <article>
            <h1 class="news__heading"><a href="<?php the_permalink();  ?>"><?php the_title();?></a></h1>
          </article>
        <?php endwhile; ?>

      <?php wp_pagenavi( array( 'query' => $loop ) ); ?>

    </div>
  </div>
</div>

<?php get_footer(); ?>
