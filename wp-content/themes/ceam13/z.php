<?php 
// OFFERS
$offers = get_post_meta(get_the_ID(), 'mb_offers', true); 
$offer_date = get_post_meta(get_the_ID(), 'mb_offer_date', true);

// BUSINESS
$business_name = get_post_meta(get_the_ID(), 'mb_business_name', true); 
$business_street = get_post_meta(get_the_ID(), 'mb_business_street', true); 
$business_city = get_post_meta(get_the_ID(), 'mb_business_city', true); 
$business_state = get_post_meta(get_the_ID(), 'mb_business_state', true);
$business_zip = get_post_meta(get_the_ID(), 'mb_business_zip', true);
$business_url = get_post_meta(get_the_ID(), 'mb_business_url', true);
$contact_name = get_post_meta(get_the_ID(), 'mb_contact_name', true);
$contact_email = get_post_meta(get_the_ID(), 'mb_contact_email', true);
$contact_phone = get_post_meta(get_the_ID(), 'mb_contact_phone', true);

// SOCIAL
$twitter = get_post_meta(get_the_ID(), 'mb_twitter', true); 
$facebook = get_post_meta(get_the_ID(), 'mb_facebook', true); 
$instagram = get_post_meta(get_the_ID(), 'mb_instagram', true);

// ACCESS POINT TYPE
$access_point_type = get_post_meta(get_the_ID(), 'mb_access_point_type', true);

// DOWNLOAD
$download_link = get_post_meta(get_the_ID(), 'mb_download_link', true);

// EVENT
$event_date = get_post_meta(get_the_ID(), 'mb_event_date', true); 
$event_time = get_post_meta(get_the_ID(), 'mb_event_time', true); 
$event_street = get_post_meta(get_the_ID(), 'mb_event_street', true);
$event_city = get_post_meta(get_the_ID(), 'mb_event_city', true);
$event_state = get_post_meta(get_the_ID(), 'mb_event_state', true);
$event_zip = get_post_meta(get_the_ID(), 'mb_event_zip', true);

// PICK UP
$pick_up_date = get_post_meta(get_the_ID(), 'mb_pick_up', true);
$pick_up_time = get_post_meta(get_the_ID(), 'mb_pick_up_time', true); 
$pick_up_street = get_post_meta(get_the_ID(), 'mb_pick_up_street', true);
$pick_up_city = get_post_meta(get_the_ID(), 'mb_pick_up_city', true);
$pick_up_state = get_post_meta(get_the_ID(), 'mb_pick_up_state', true);
$pick_up_zip = get_post_meta(get_the_ID(), 'mb_pick_up_zip', true);
?>






<?php 
//OFFERS
if ($offers !== '') { echo "<li>" . $offers."</li>";} 
if ($offer_date !== '') { echo "<li>" . $offer_date."</li>";} 

//BUSINESS
if ($business_name !== '') { echo "<li>" . $business_name."</li>";}
if ($business_street !== '') { echo "<li>" . $business_street."</li>";} 
if ($business_city !== '') { echo "<li>" . $business_city."</li>";} 
if ($business_state !== '') { echo "<li>" . $business_state."</li>";} 
if ($business_zip !== '') { echo "<li>" . $business_zip."</li>";} 
if ($business_url !== '') { echo "<li>" . $business_url."</li>";} 
if ($contact_name !== '') { echo "<li>" . $contact_name."</li>";} 
if ($contact_email !== '') { echo "<li>" . $contact_email."</li>";}
if ($contact_phone !== '') { echo "<li>" . $contact_phone."</li>";} 
 
// SOCIAL
if ($twitter !== '') { echo "<li>" . $twitter."</li>";}
if ($facebook !== '') { echo "<li>" . $facebook."</li>";} 
if ($instagram !== '') { echo "<li>" . $instagram."</li>";}
// ACCESS POINT TYPE  
if ($access_point_type !== '') { echo "<li>" . $access_point_type."</li>";}
// DOWNLOAD 

if ($download_link !== '') { echo "<li>" . $download_link."</li>";} 
//EVENT
if ($event_date !== '') { echo "<li>" . $event_date."</li>";} 
if ($event_time !== '') { echo "<li>" . $event_time."</li>";}
if ($event_street !== '') { echo "<li>" . $event_street."</li>";}
if ($event_city !== '') { echo "<li>" . $event_city."</li>";} 
if ($event_state !== '') { echo "<li>" . $event_state."</li>";} 
if ($event_zip !== '') { echo "<li>" . $event_zip."</li>";}

//PICK UP
if ($pick_up_date !== '') { echo "<li>" . $pick_up_date."</li>";}
if ($pick_up_time !== '') { echo "<li>" . $pick_up_time."</li>";}
if ($pick_up_street !== '') { echo "<li>" . $pick_up_street."</li>";}
if ($pick_up_city !== '') { echo "<li>" . $pick_up_city."</li>";} 
if ($pick_up_state !== '') { echo "<li>" . $pick_up_state."</li>";}
if ($pick_up_zip !== '') { echo "<li>" . $pick_up_zip."</li>";}
?>






<!--
// BUSINESS meta box

<?php $business_name = get_post_meta(get_the_ID(), 'mb_business_name', true); if ($business_name !== '') { echo "<li>" . $business_name."</li>";} ?>
<?php $business_street = get_post_meta(get_the_ID(), 'mb_business_street', true); if ($business_street !== '') { echo "<li>" . $business_street."</li>";} ?>
<?php $business_city = get_post_meta(get_the_ID(), 'mb_business_city', true); if ($business_city !== '') { echo "<li>" . $business_city."</li>";} ?>
<?php $business_state = get_post_meta(get_the_ID(), 'mb_business_state', true); if ($business_state !== '') { echo "<li>" . $business_state."</li>";} ?>
<?php $business_zip = get_post_meta(get_the_ID(), 'mb_business_zip', true); if ($business_zip !== '') { echo "<li>" . $business_zip."</li>";} ?>
<?php $business_url = get_post_meta(get_the_ID(), 'mb_business_url', true); if ($business_url !== '') { echo "<li>" . $business_url."</li>";} ?>
<?php $contact_name = get_post_meta(get_the_ID(), 'mb_contact_name', true); if ($contact_name !== '') { echo "<li>" . $contact_name."</li>";} ?>
<?php $contact_email = get_post_meta(get_the_ID(), 'mb_contact_email', true); if ($contact_email !== '') { echo "<li>" . $contact_email."</li>";} ?>
<?php $contact_phone = get_post_meta(get_the_ID(), 'mb_contact_phone', true); if ($contact_phone !== '') { echo "<li>" . $contact_phone."</li>";} ?>


// ENGAGEMENT 
<?php $twitter = get_post_meta(get_the_ID(), 'mb_twitter', true); if ($twitter !== '') { echo "<li>" . $twitter."</li>";} ?>
<?php $facebook = get_post_meta(get_the_ID(), 'mb_facebook', true); if ($facebook !== '') { echo "<li>" . $facebook."</li>";} ?>
<?php $instagram = get_post_meta(get_the_ID(), 'mb_instagram', true); if ($instagram !== '') { echo "<li>" . $instagram."</li>";} ?>


// ACCESS POINT TYPE
<?php $access_point_type = get_post_meta(get_the_ID(), 'mb_access_point_type', true); if ($access_point_type !== '') { echo "<li>" . $access_point_type."</li>";} ?>

// DOWNLOAD
<?php $download_link = get_post_meta(get_the_ID(), 'mb_download_link', true); if ($download_link !== '') { echo "<li>" . $download_link."</li>";} ?>

//EVENT
<?php $event_date = get_post_meta(get_the_ID(), 'mb_event_date', true); if ($event_date !== '') { echo "<li>" . $event_date."</li>";} ?>
<?php $event_time = get_post_meta(get_the_ID(), 'mb_event_time', true); if ($event_time !== '') { echo "<li>" . $event_time."</li>";} ?>
<?php $event_street = get_post_meta(get_the_ID(), 'mb_event_street', true); if ($event_street !== '') { echo "<li>" . $event_street."</li>";} ?>
<?php $event_city = get_post_meta(get_the_ID(), 'mb_event_city', true); if ($event_city !== '') { echo "<li>" . $event_city."</li>";} ?>
<?php $event_state = get_post_meta(get_the_ID(), 'mb_event_state', true); if ($event_state !== '') { echo "<li>" . $event_state."</li>";} ?>
<?php $event_zip = get_post_meta(get_the_ID(), 'mb_event_zip', true); if ($event_zip !== '') { echo "<li>" . $event_zip."</li>";} ?>

//PICK UP
<?php $pick_up_date = get_post_meta(get_the_ID(), 'mb_pick_up', true); if ($pick_up_date !== '') { echo "<li>" . $pick_up_date."</li>";} ?>
<?php $pick_up_time = get_post_meta(get_the_ID(), 'mb_pick_up_time', true); if ($pick_up_time !== '') { echo "<li>" . $pick_up_time."</li>";} ?>
<?php $pick_up_street = get_post_meta(get_the_ID(), 'mb_pick_up_street', true); if ($pick_up_street !== '') { echo "<li>" . $pick_up_street."</li>";} ?>
<?php $pick_up_city = get_post_meta(get_the_ID(), 'mb_pick_up_city', true); if ($pick_up_city !== '') { echo "<li>" . $pick_up_city."</li>";} ?>
<?php $pick_up_state = get_post_meta(get_the_ID(), 'mb_pick_up_state', true); if ($pick_up_state !== '') { echo "<li>" . $pick_up_state."</li>";} ?>
<?php $pick_up_zip = get_post_meta(get_the_ID(), 'mb_pick_up_zip', true); if ($pick_up_zip !== '') { echo "<li>" . $pick_up_zip."</li>";} ?>

-->

	
	
	
	
	
	
@media only screen and (-webkit-min-device-pixel-ratio: 1.5), 
only screen and (min--moz-device-pixel-ratio: 1.5), 
only screen and (min-device-pixel-ratio: 1.5) {
  /* 2x =================================================== */
    
}


@media only screen and (max-device-width: 480px) and (orientation:landscape) { /* iPhone [landscape ] */

}


@media only screen and (max-device-width: 480px) and (orientation:portrait) { /* iPhone [portrait ] */
	/* .width {max-width: 440px;} */
	/* .width {background: red;} */
	.width {max-width:95%;}
	nav	{ font-size: 3em;}
	
	nav ul{ float:none !important;}
	nav li{ float:none; text-align: center; border-bottom: 2px solid #ccc }
	nav ul ul{
	display:block;
	margin:0;
	padding:0;
	position: relative;
	list-style:none;
	width: 100%;
	}

	nav ul ul a{ background:white !important; color:#B7272D !important;}
	nav ul li:hover ul{ /* Display the dropdown on hover */
	display: inline;
	}

	.entry .em2, .entry h3 {font-size: 3em;} 
	.entry p, .entry li {font-size: 3em;}
	.unit {float:none;}
	.size1of2, .size1of4, .size3of4 {width: 100%;}
	.commercial, .residential {text-align: center;}
	
	.tagline, .wpsocialite.small {display: none;}
	
	a.phonenumber { font-size: 7em; text-align: center;margin-right: 0;float: none;}
	h2.script, h3.script, h2.sectionhead {font-family: "klavika-web", arial, sans-serif; font-size: 3em;}
	
	.make-gallery div	{ float: none; list-style: none; text-align: center;}
	.make-gallery p	{ font-size: 2em;}
	
	.square-3-titles	div { width: 100%; height: auto; padding-bottom: 0; }

}

/* == iPad/iPhone [portrait + landscape] == */
@media only screen and (max-device-width: 768px) and (orientation:portrait) { /* iPhone [portrait ] */

	.wpsocialite.small {display: none;}
	.square-3-titles	div { width: 33.3333%; height: 0; padding-bottom: 65%; }
}

@media only screen and (max-device-width: 768px) and (orientation:landscape) { /* iPhone [portrait ] */

	.wpsocialite.small {display: none;}
}








FILTER
		<ul id="filter_me">
				<?php
					$query = 'news';
					
					$queryObject = new WP_Query(array('posts_per_page' => 3, 'order' => 'DESC' ) );
					
					// The Loop...
					if ($queryObject->have_posts()) { while ($queryObject->have_posts()) { $queryObject->the_post(); ?>
					
					<li>
					
						<div class="meta">
							<?php //the_time('M j, Y ') ?>
						</div>
						<div class="content">
							<hgroup>
								<h1 class="h1 sansSerif upCase"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
							</hgroup>
							<?php global $more; $more = 0;?>
							<?php the_content(); ?>
							
							<?php if ( empty($tags) ) the_tags('<h3>Tags: ',', ','</h3>'); ?>
							
							<?php //echo get_the_term_list($post->ID, 'client', '', ', ', ''); ?>
						</div>
						<div class="image">
							<?php //the_post_thumbnail(array(130,130)); ?>
							<?php // comments_popup_link('Comments: 0','Comments: 1','Comments: %'); ?>
							
						</div>
					</li>
				
				<?php	
						}
					}
				?>
					<li>
						<div class="meta">Latest Tweet</div>
	
						<div class="content tweet"></div>
						<div class="image"><!-- <a href="http://twitter.com/segl">Follow SEGL</a> --></div>
					</li>
				</ul>


SLIDER

	<div id="slider">
		<ul class="slides">
			
			<?php
				$feature = 'posts_per_page=-1';
				
				$featureObject = new WP_Query($feature);
				
				// The Loop...
				if ($featureObject->have_posts()) { while ($featureObject->have_posts()) { $featureObject->the_post(); ?>
						
										
			<li>	
				<a class="" href="<?php the_permalink(); ?>"><?php //the_post_thumbnail('feature-image'); ?></a>
				<?php // echo get_the_term_list($post->ID, 'client', '<h3>', '', '</h3>'); ?>
				<!--<span class="date"><?php // the_time('M j, Y ') ?></span>-->
			</li>
			
			<?php	
					}
				}
			?>
			<!-- <li><a href="/student-life"><img src="http://812test.com/wp-content/uploads/2010/06/studentLife.jpg" alt="" /></a></li>-->

		</ul><!-- End Recent Work-->
		
		<a href="#" class="prev">&laquo;</a>
		<a href="#" class="next">&raquo;</a>
		<ul id="socialMedia">
			<li><a href="http://feeds.feedburner.com/schoolforethics"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="Subscribe to SEGL's RSS feed" /></a></li>
			<li><a href="http://twitter.com/812studio"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" alt="SEGL on Twitter" /></a></li>
			<li><a href=""><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" alt="SEGL on Facebook" /></a></li>
		</ul>
	</div>