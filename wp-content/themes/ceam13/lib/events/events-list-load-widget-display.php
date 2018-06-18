<?php

// Vars set:
// '$event->AllDay',
// '$event->StartDate',
// '$event->EndDate',
// '$event->ShowMapLink',
// '$event->ShowMap',
// '$event->Cost',
// '$event->Phone',

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

$event = array();
$tribe_ecp = TribeEvents::instance();
reset($tribe_ecp->metaTags); // Move pointer to beginning of array.
foreach($tribe_ecp->metaTags as $tag){
	$var_name = str_replace('_Event','',$tag);
	$event[$var_name] = tribe_get_event_meta( $post->ID, $tag, true );
}

$event = (object) $event; //Easier to work with.

ob_start();
	post_class($alt_text,$post->ID);
$class = ob_get_contents();
ob_end_clean();
?>

<li class="line">
	<div class="unit size6of8">
		<h2 class="em2 condensed pad1to1sm"><a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a></h2>
		<?php if(has_post_thumbnail()) { ?><div class="mlr"><?php the_post_thumbnail('large', array('class' => 'borderLight')); ?></div><?php } ?>
		<div class="event_body"><?php the_content('... More');?></div>
		<?php $alt_text = ( empty( $alt_text ) ) ? 'alt' : ''; ?>
	</div>
	<div class="unit size2of8">
		<p class="when pt3"><?php echo tribe_get_start_date(); ?></p>
		<p class="loc"><?php if ( tribe_get_venue() != '' ) { echo tribe_get_venue() . ', '; } ?></p>
	</div>
</li>