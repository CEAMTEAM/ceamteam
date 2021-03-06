<?php get_header(); ?>

<div>


	<?php if (have_posts()) : while (have_posts()) : the_post();?>



	<?php // if(has_post_thumbnail()) { the_post_thumbnail('feature-border', array('class' => 'borderLight'));} ?>

		<div id="entry" class="center size3of4 listOn">
			<h2 class="em2 pad1to1sm boxShadowBottom"><?php single_post_title(); ?></h2>
			<?php // the_content();?>
		</div>

	<?php endwhile; endif; ?>

	<div class="line center size2of3">

			<?php
				$query = 'testimonial';
				$queryObject = new WP_Query(
				array(
				'post_type' => 'cpt_testimonial',
				'posts_per_page' => -1
				//'order' => 'DESC'
				));

				// The Loop...
				if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>

				<article class="line boxShadowBottom">
					<div class="unit size1of4">
						<?php if(has_post_thumbnail()) { ?><div class="pt1"><?php the_post_thumbnail('medium', array('class' => 'borderShadowBottom')); ?></div><?php } ?>
					</div>
					<div class="unit size3of4 pb1">
						<h2 class="em2 pad1to1sm"><?php the_title();?></h2>
						<?php the_content();?>
					</div>
				</article>

				<?php	} }?>

		</div>

</div>

<?php get_footer(); ?>
