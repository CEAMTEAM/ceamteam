<?php get_header(); ?>

	<h6 class="bold em2 pad1to1sm"><?php the_title(); ?></h6>
<div class="min600">	

	<?php 
		query_posts(array('post_type' => array('events'), 'post_status' => 'future', 'posts_per_page' => 5, 'order' => 'ASC'));?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="line boxShadowTop">
		
			<div class="unit size1of5">
				<h6 class="pad1to1sm"><?php the_time('m/j/Y ') ?></h6>
			</div>
			<div class="unit size4of5">
				<h2 class="bold pad1to1sm"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				
				
				<?php 
				 /*
				 $eventTime1 = get_post_meta(get_the_ID(), 'rw_eventTime', true);
				 $eventTime2 = get_post_meta(get_the_ID(), 'rw_eventTime2', true);
				 $eventPrice = get_post_meta(get_the_ID(), 'rw_eventPrice', true);
				 $eventLocation = get_post_meta(get_the_ID(), 'rw_eventLocation', true);
				 $eventTicketsUrl = get_post_meta(get_the_ID(), 'rw_eventTicketsUrl', true); 
				
				 if ($eventTime1||$eventPrice||$eventLocation !== '') { echo "<h3>Event Details</h3><ul class=boxShadowBottom>";} 
				 if ($eventTime1 !== '') { echo "<li><span class=bold>When:</span>" . $eventTime1."</li>";} 
				 if ($eventTime2 !== '') { echo "<li><span class=bold>Show 2:</span>" . $eventTime2."</li>";} 					  
				 if ($eventPrice !== '') { echo "<li><span class=bold>Price:$</span>" . $eventPrice."</li>";}
				 if ($eventLocation !== '') { echo "<li><span class=bold>Location: </span>" . $eventLocation."</li>";}
				 if ($eventTime1||$eventPrice||$eventLocation !== '') { echo "</ul>";} 
				 
				 if ($eventTicketsUrl !== '') { echo "<p><a class=gleam-button href=".$eventTicketsUrl.">Purchase Tickets</a></p>";} 
				 */
				?>
		
				
				<?php // the_content(); ?>
			</div>
		</article>
			
		<?php endwhile; else: ?>
		
		<!-- <p>No featured events scheduled.</p>  -->
		
	<?php endif; ?> 
</div>

<?php get_footer(); ?>