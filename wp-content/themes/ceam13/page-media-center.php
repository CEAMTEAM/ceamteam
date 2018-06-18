<?php get_header(); ?>

<div>

	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} ?>

		<div class="center size6of8 listOn entry">
			<?php the_content();?>
		</div>

	<?php endwhile; endif; ?>

		<div class="line width">

            <div class="right size2of3">

                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $myquery = new WP_Query(
                    array(
                        'post_type' => array('post'),
                        'posts_per_page' => '10',
                        'paged'=>$paged
                    )
                );
                ?>

                <?php
                if ($myquery->have_posts()) :  while ($myquery->have_posts()) : $myquery->the_post();
                ?>

            <article class="pb1 line boxShadowBottom">
						    <div class="pt1">
    						    <?php
								 if ( has_post_thumbnail()) {
								   $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
								   echo "<div class='CoverImage FlexEmbed FlexEmbed--16by9 circle-img' style=background-image:url($full_image_url[0]) ></div>";
								 } ?>

    						    <h1 class="em2 p0 lh1"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    							<?php echo '<p>' . wp_trim_words( get_the_content(), 30 ) . '</p>'; ?>
    							<p><?php the_tags(); ?></p>


						    </div>

						</article>

                <?php endwhile; ?>
                <?php wp_pagenavi( array( 'query' => $myquery ) ); ?><!-- IMPORTANT: make sure to include an array with your previously declared query values in here -->
                <?php wp_reset_query(); ?>
                <?php else : ?>
                <p>No posts found</p>
                <?php endif; ?>



		</div>

		<div class="left size1of3 rHide pad1to1sm em2">
			<h2 class="p0 textC white purpleBg">Categories</h2>
			<ul class="catBox">
			<?php wp_list_categories('orderby=name&hide_empty=0&title_li=0'); ?>
			</ul>
		</div>


	</div>



</div>


<?php get_footer(); ?>
