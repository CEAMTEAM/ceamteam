<?php get_header(); ?>

<div>
		
    <h1 class="em2 textC ltBlue pad1to1sm"><?php the_title();  ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		
	<?php // if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>
	

		<div class="center size2of3 listOn entry">
		

		    <h2 class="textC">Brought to you by CEAM</h2>
		    <div class="records">
	            <input class="msip5 typeahead" type="text" placeholder="Enter a school's name..." />
	        </div>

		
			<?php the_content();?>
			
		</div>
	
	<?php endwhile; endif; ?>
			
</div>
					
<?php get_footer(); ?>