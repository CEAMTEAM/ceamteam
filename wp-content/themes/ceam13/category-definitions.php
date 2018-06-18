<?php get_header(); ?>

<div>

	<h2 class="em2 bold pad1to1sm"><?php single_cat_title(); ?></h2>
		
		<?php query_posts(array( 'post_type' => 'resources', 'category_name' => 'definitions', 'posts_per_page' => -1, 'orderby' => 'title','order' => 'ASC'));?>

		<?php  if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="line boxShadowTop pb1">
		
			<div class="unit size1of4">
				<h2 class="bold pad1to1"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			</div>
			<div class="unit size3of4">				
				<?php the_content(); ?>
			</div>
		</article>
		
		<?php endwhile; endif;?>
	
</div>
<?php get_footer(); ?>