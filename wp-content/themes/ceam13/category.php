<?php get_header(); ?>

<div>
		
		<div class="center size6of8 listOn entry">
			<h1 class="em3 textC purple pad1to1sm"><?php single_cat_title();  ?></h1>
		</div>
		
		<div class="line width">	

            <div class="right size2of3">
			
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                        <article class="pb1 line boxShadowBottom">
						    <div class="pt1">
    						    <?php 
								 if ( has_post_thumbnail()) {
								   $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
								   echo "<div class='CoverImage FlexEmbed FlexEmbed--16by9 circle-img' style=background-image:url($full_image_url[0]) ></div>";
								 } ?>
		
    						    <h1 class="em2 p0"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    							<?php echo '<p>' . wp_trim_words( get_the_content(), 30 ) . '</p>'; ?>
    							<p><?php the_tags(); ?></p>
                                    
						    </div>
							
						</article>
                
                 <?php endwhile; else: ?>
						
				<?php endif; ?> 
				
				<?php wp_pagenavi(); ?>
				
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