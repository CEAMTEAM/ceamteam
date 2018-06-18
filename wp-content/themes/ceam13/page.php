<?php get_header(); ?>

<div>

	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>

		<div id="entry" class="center size3of4 listOn">
			<h2 class="em2 boxShadowBottom pad1to1sm"><?php single_post_title(); ?></h2>
			<div>
				<?php the_content();?>
			</div>
		</div>

	<?php endwhile; endif; ?>


</div>


<?php get_footer(); ?>
