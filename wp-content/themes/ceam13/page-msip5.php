<?php get_header(); ?>

<div>
		
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		
	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>
		
		<div class="center size6of8 listOn entry">
			<?php the_content();?>
		</div>
	
	<?php endwhile; endif; ?>

		
		<div class="center size6of8">	
                <ol id="dates">Date</ol>
                
              <table id="my-ajax-table" class="data">
			  <thead>
			    <th>Year</th>
			    <th>Agency</th>
			    <th>School</th>
			    <th>Percentage</th>
			    <th>Grade</th>
			  </thead>
			  <tbody>
			  </tbody>
			</table>
			
		</div>

</div>
			
					
<?php get_footer(); ?>