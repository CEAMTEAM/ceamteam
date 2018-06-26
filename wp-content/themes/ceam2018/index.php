<?php get_header(); ?>

<?php

  $args = array(
    'category_name' => 'category-slug',
    'post_type' => 'post'
  );

// Custom query.
$query = new WP_Query( $args );

// Check that we have query results.
if ( $query->have_posts() ) {

    echo '<ul class="category posts">';

        // Start looping over the query results.
        while ( $query->have_posts() ) {

            $query->the_post();

            ?>

            <li <?php post_class( 'left' ); ?>>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>

            <?php

        }

    echo '</ul>';

}

// Restore original post data.
wp_reset_postdata();

?>

<?php get_footer(); ?>
