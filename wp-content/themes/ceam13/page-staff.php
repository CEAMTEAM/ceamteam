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
				$query = 'staff';
				$queryObject = new WP_Query(
				array(
				'post_type' => 'cpt_staff',
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
						<h2 class="em2 pad1to1sm"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<?php
							$title = get_post_meta(get_the_ID(), 'tf_title', true);
							$email = get_post_meta(get_the_ID(), 'tf_email', true);
							if ($email !== '') {
								echo "<p>$title - <a href=mailto:$email>Email</a></p>";
							} else {
							echo "<p>$title</p>";}
						?>

						<?php the_content();?>
					</div>
				</article>

				<?php	} }?>

		</div>

</div>

<?php //get_utilityBar(); ?>

<?php get_footer(); ?>
