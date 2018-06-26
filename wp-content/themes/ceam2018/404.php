<?php get_header(); ?>

  <div class="feature__layer" style="background-image: url(/wp-content/uploads/2009/12/oldShed.jpg);">
    <div class="feature__container">
      <div class="feature__main">

        <?php include "svg/earthdance-logo.php" ?>

        <h1 class="feature__heading">Sorry, that page doesn't exist</h1>

      </div>
    </div>
  </div>


<div class="news__layer">
  <div class="news__container">
    <div class="page__content">

      <h2>Here are some articles to check out:</h2>
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
