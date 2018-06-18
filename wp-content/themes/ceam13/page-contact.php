<?php get_header(); ?>

<div class="textC">
	<h1 class="em3 textC pad1to1sm">How can we help you today?</h1>
</div>

<div class="line width">

	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>

		<div class="right size2of3 entry">
			<?php the_content();?>

			<p><img src="<?php bloginfo('template_url'); ?>/lib/images/directions.png" alt="" /></p>
		</div>

		<div class="left size1of3  pt1">
		    <h2 class="white ltBlueBg pad1to1sm textC rounded">Contact</h2>

    		  <div class="sideBar mlr" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			     <div class="mlr pt1">
			        <span>CEAM.</span><br/>
    			     <span  itemprop="streetAddress">1310 Papin St. Suite 106</span><br/>
    			     <span  itemprop="addressLocality">St. Louis</span>,
    			     <span  itemprop="addressRegion">MO</span>
    			     <span  itemprop="postalCode">63103</span>
			     </div>
    		  </div>
			 <div class="sideBar mlr pb1">
			   <span class="mlr" itemprop="telephone">314-454-6544</span> <span class="bold">main</span><br/>
			 </div>
		</div>

	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>
