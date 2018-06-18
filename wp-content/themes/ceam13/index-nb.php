<?php get_header();?>


<div class="width">

			<?php
			$query = 'feature';
			$queryObject = new WP_Query(
			array(
			'post_type' => 'feature',
			'posts_per_page' => 1
			));

			// The Loop...
			if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>

			<?php  $full = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
			<?php $linkurl = get_post_meta(get_the_ID(), 'tf_linkurl', true);?>

			<article>

				<div class="stretch textC" style="background-image:url(<?php echo $full; ?>);">
					<h2 class="pad3to3 em3 condensed thin"><a class="button" href="<?php echo $linkurl; ?>"><?php the_title();?></a></h2>
					<!-- <a href="">GO!</a> -->
				</div>

			</article>

			<div class="center size3of4">
				<div class="pad2to1 textC">
					<h2 class="em2 "><a class="button" href="category/in-the-news/">News</a></h2>

					<?php	} }?>


					<?php
					$query = 'post';
					$queryObject = new WP_Query(
					array(
					'post_type' => 'post',
					'order' => 'DESC',
					'posts_per_page' => 3
					));

					// The Loop...
					if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>


					<article class="boxShadowBottom textC">

						<h2 class="pad1to1sm em2 condensed"><?php // the_time('M, j') ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>

					</article>

					<?php	} }?>
				</div>


				<div class="pad2to1 textC">
					<h2 class="em2 "><a class="button" href="/resources/">Resources</a></h2>

					<?php
					$query = 'resources';
					$queryObject = new WP_Query(
					array(
					'post_type' => 'cpt_resources',
					'posts_per_page' => 3
					));

					// The Loop...
					if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>

					<article class="boxShadowBottom textC">

						<h2 class="pad1to1sm em2 condensed"><?php // the_time('M, j') ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>

					</article>

					<?php	} }?>
				</div>


				<div class="pad2to1 textC">
					<h2 class="em2 "><a class="button" href="http://ceamteam.nationbuilder.com/events/">Events</a></h2>

					<article class="boxShadowBottom pad1to1sm">
              <h2 class="p0 em2 condensed"><a href="http://ceamteam.nationbuilder.com/events/">Visit our events page</a></h2>
          </article>

				</div>


				<div class="pad2to1 textC">
					<p>The release of Missouri’s Annual Performance Report and Missouri Assessment Program scores are intended to give the public a look at how our state’s public schools are performing. Below is a map that shows school districts that are unaccredited, provisionally accredited or nearing a loss of their full accreditation. If you click on one of the markers you can see what the districts’ APR is and other useful information.</p>
    			<p><iframe src="//batchgeo.com/map/e0c1e296f8d976b2785a299d0279eb0b" frameborder="0" width="100%" height="550" style="border:1px solid #aaa;border-radius:10px;"></iframe></p><p><small>View <a href="http://batchgeo.com/map/e0c1e296f8d976b2785a299d0279eb0b">District APA's</a> in a full screen map</small></p>

				</div>

			</div>
	</div>

<?php get_footer(); ?>
