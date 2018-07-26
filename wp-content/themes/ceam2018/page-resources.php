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
        <div class="page__content">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $myquery = new WP_Query(
                    array(
                        'post_type' => array('cpt_resources'),
                        'posts_per_page' => '10',
                        'paged'=>$paged
                    )
                );
            ?>

            <?php
                if ($myquery->have_posts()) :  while ($myquery->have_posts()) : $myquery->the_post();
            ?>

            <article class="pb1 line boxShadowBottom">
                <div class="pt1">
                    <h1 class="em2 p0 lh1"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
                    <?php echo '<p>' . wp_trim_words( get_the_content(), 30 ) . '</p>'; ?>
                </div>
            </article>

            <?php endwhile; ?>
                <?php wp_pagenavi( array( 'query' => $myquery ) ); ?><!-- IMPORTANT: make sure to include an array with your previously declared query values in here -->
            <?php wp_reset_query(); ?>
            <?php else : ?>
            <p>No posts found</p>
            <?php endif; ?>

        </div>
	</div>
</div>

<?php get_footer(); ?>
