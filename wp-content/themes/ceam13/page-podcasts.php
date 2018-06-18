<?php get_header(); ?>

<div>
		
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		
	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>
		
		<div class="center size2of3 listOn entry pb1">
			<?php the_content();?>
		</div>
	
	<?php endwhile; endif; ?>

		
		<div class="line center size2of3">	
			
			<?php query_posts(array(
					'post_type' => array('cpt_podcasts'), 
					'posts_per_page' => -1, 
					'order' => 'DESC'
				));
			?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<article class="boxShadowTop pad1to1sm">
				<h1 class=""><?php the_time('M, Y'); ?> - <a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
				<?php global $more; $more = 0; ?>
				<?php //the_content();?>
			</article>
		
		<?php endwhile; else: ?>
			
			
		<?php endif; ?> 
		</div>

</div>
			
					
<?php get_footer(); ?>