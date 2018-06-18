	<div id="slider">
		<!-- Make these Articles -->
		<ul class="slides nomp line boxShadowBottom">
		
			<?php
				$featureLoop = new WP_Query(array(
					'category_name' => 'resources', 
					'posts_per_page' => '5',
					'orderby' => 'rand'
					//'order' => 'ASC'
					));
				
				if ($featureLoop->have_posts()) { while ($featureLoop->have_posts()) { $featureLoop->the_post(); ?>
										
				<li>	
					<?php 
						$permalink = get_permalink( $id );
						$linkText = get_post_meta($post->ID, 'rw_linkText', true); 
						$buttonColor = get_post_meta($post->ID, 'rw_buttonColor', true); 
						$borderFeature = get_post_meta($post->ID, 'rw_borderFeature', true); 
						
						//if ($linkText !== '')  { echo "<a class=" . 'featureButton' . $buttonColor . " href=". $permalink .">". $linkText ."</a>";}
						
					?>
					
					<?php the_post_thumbnail('feature-image', array('class' => $borderFeature)); ?>
					<span class="h1 slide-title"><?php the_title();?></span>
															
					<a href="<?php the_permalink(); ?>" class="h2 featureButton"><?php echo $linkText; ?></a>
				
			<?php } } ?>

			<!-- <li><a href="/student-life"><img src="http://812test.com/wp-content/uploads/2010/06/studentLife.jpg" alt="" /></a></li>-->

		</ul><!-- End Recent Work-->
		
		<a href="#" class="prev">></a>
		<a href="#" class="next">></a>
	</div>