<?php get_header(); ?>

<div class="line width">

    <h1 class="em2 textC pad1to1sm"><?php the_title();  ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<div id="entry" class="center size3of4 listOn pad1to2">
		<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>

		<p class="gray italics thin"><?php the_time('M j, Y '); ?> </p>
		<?php the_content();?>

		<div class="pad2to1 line">
			<?php  wpsocialite_markup();  ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>

	<?php endwhile; endif; ?>


	<ul class="line clear boxShadowTop pad1to2">
		<li id="prev" class="p"> &laquo; Previous Post: <?php previous_post_link('%link'); ?></li>
		<li id="next" class="p"> &raquo; Next Post: <?php next_post_link('%link'); ?></li>
	</ul>

</div>

<?php get_footer(); ?>
