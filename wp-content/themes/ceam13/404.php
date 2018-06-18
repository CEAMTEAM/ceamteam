<?php get_header(); ?>

<div class="pad1to1" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	
	
	<?php if(has_post_thumbnail()) { ?>
	<div class="pb1">
		<?php the_post_thumbnail('feature-border', array('class' => 'borderLight')); ?>
	</div>
	<?php } ?>
	
	<div class="center size3of4">
		<h2 class="em2 bold pad1to1sm"><?php single_post_title(); ?></h2>
		
		<div id="entry" class=" listOn">
			<?php the_content();?>
		</div>
	</div>
		
	<?php endwhile; else: ?>
		
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
		
</div>			
			
<?php get_footer(); ?>