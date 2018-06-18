<!-- the default values http://ogp.me/ -->  
<meta property="fb:admins" content="680313226" />

<?php if (is_home()) { ?> 
<!-- FB opengraph for homepage -->   
<meta property="og:url" content="<?php echo home_url(); ?>" />   
<meta property="og:locale" content="en_US"/>  
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
<meta property="og:title" content="<?php bloginfo('name');  ?>" /> 
<meta property="og:description" content="We make awesome websites that build trust, interest and loyalty in your business." />  
<meta property="og:type" content="website" />  
<meta property="og:image" content="<?php bloginfo('template_url') ?>/images/solvm-logo-2.png" /> 
<?php } ?> 
  
<?php if (is_page()) { ?>
<!-- FB opengraph for pages --> 
<meta property="og:url" content="<?php the_permalink() ?>"/>   
<meta property="og:locale" content="en_US"/>  
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
<meta property="og:title" content="<?php bloginfo('name');  ?>" /> 
<meta property="og:description" content="We make awesome websites that build trust, interest and loyalty in your business." />  
<meta property="og:type" content="website" />  
<meta property="og:image" content=<?php if(has_post_thumbnail()) { echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } else { echo bloginfo('template_url').'/images/solvm-logo-2.png'; } ?> />
<?php } ?>

<?php if (is_single()) { ?>  
<!-- FB Article opengraph for single pages --> 
<meta property="og:url" content="<?php the_permalink() ?>"/>
<meta property="og:locale" content="en_US"/>   
<meta property="og:title" content="<?php single_post_title(''); ?>" />  
<!--<meta property="og:description" content="<?php //echo strip_tags(get_the_excerpt($post->ID)); ?>" /> -->
<meta property="og:description" content="<?php
	$my_postid = $post->ID;//This is page id or post id
	$content_post = get_post($my_postid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]>', $content);
	echo strip_tags($content);
?>" />  
<meta property="og:type" content="article" />  
<meta property="og:image" content=<?php if(has_post_thumbnail()) { echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } else { echo bloginfo('template_url').'/images/solvm-logo-2.png'; } ?> />
<?php } ?>