<?php get_header(); ?>

<div class="pad1to1 greenBg">
		
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		
	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>
		
		<div class="center size1of2 listOn entry">
			<?php the_content();?>
		</div>
	
	<?php endwhile; endif; ?>
		
</div>

<div class="pad1to1 lightGreenBg">
	
	<?php 
	$query = 'team';
	$queryObject = new WP_Query(array('post_type' => 'cpt_company', 'posts_per_page' => -1, 'order' => 'ASC' ) );
		
		// The Loop...
		if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>
						
		<div class="center size1of2 listOn entry pb1">
			<h2><?php the_title();?><?php $title = get_post_meta(get_the_ID(), 'tf_title', true); echo " - " . "<span class=thin>" . $title . "</span>";?></h2>
			<?php the_content();?>
		</div>
	
<?php } }?>

</div>
			
<?php get_footer(); ?>