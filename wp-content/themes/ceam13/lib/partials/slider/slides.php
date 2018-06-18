	<div id="slider" class="banner-m home-banner line">
		<!-- Make these Articles -->
		<ul class="slides line h1 bold">
		
			<?php
				$featureLoop = new WP_Query(array(
					'category_name' => 'advice', 
					'posts_per_page' => '3',
					'orderby' => 'rand'
					//'order' => 'ASC'
					));
				
				if ($featureLoop->have_posts()) { while ($featureLoop->have_posts()) { $featureLoop->the_post(); ?>
										
				<li><a class="center-sign inline gleam-button letterpress-bt" href=<?php the_permalink();?>><?php the_title();?></a></li>
				
			<?php } } ?>

			<!-- <li><a href="/student-life"><img src="http://812test.com/wp-content/uploads/2010/06/studentLife.jpg" alt="" /></a></li>-->

		</ul><!-- End Recent Work-->
		
	</div><!-- End Slider -->