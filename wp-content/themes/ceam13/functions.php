<?php

add_action( 'after_setup_theme', 'ceam13_theme_setup' );

function ceam13_theme_setup() {

	//----------------------------------------------------------------------------

	// Remove junk from head

		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

	//----------------------------------------------------------------------------
	// Add default posts and comments RSS feed links to head

		add_theme_support('automatic-feed-links');

	//----------------------------------------------------------------------------
	// Add theme support for Post Formats
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	//----------------------------------------------------------------------------

/*
    	if ( function_exists('register_sidebar') ){
		    register_sidebar(array(
		        'name' => 'widgetz',
		        'before_widget' => '<div id="W">',
		        'after_widget' => '</div>',
		        'before_title' => '<h2 class="hidden">',
		        'after_title' => '</h2>',
		        ));
		}
*/


	//----------------------------------------------------------------------------
	  	// Enable post thumbnails
		add_theme_support( 'post-thumbnails' );

		//set_post_thumbnail_size( 240, 240, true ); // 140 pixels wide by 140 pixels tall, hard crop mode
		//add_image_size( 'gallery-2up', 452, 452, true );

		/*
		Media sizes to set in WordPress

		Thumb		120 x 120
		Medium	290 x 288
		Large			610 x 402			610 x 520 (full no border)  589 x 402 (to include a 11px border)

		Maximun Embed Size	610 x 402
		*/

	//Force Cropping on Medium Images
		if(false === get_option("medium_crop"))
	    	add_option("medium_crop", "1");
		else
	    	update_option("medium_crop", "1");

	 //Force Cropping on LARGE Images
		if(false === get_option("large_crop"))
	    	add_option("large_crop", "1");
		else
	    	update_option("large_crop", "1");


//----------------------------------------------------------------------------
	// Tells WP not to hardcode height and width in to output
/**
 * This is a modification of image_downsize() function in wp-includes/media.php
 * we will remove all the width and height references, therefore the img tag
 * will not add width and height attributes to the image sent to the editor.
 *
 * @param bool false No height and width references.
 * @param int $id Attachment ID for image.
 * @param array|string $size Optional, default is 'medium'. Size of image, either array or string.
 * @return bool|array False on failure, array on success.
 */

function myprefix_image_downsize( $value = false, $id, $size ) {
	if (!is_admin()) {
	    if ( !wp_attachment_is_image($id) )
	        return false;

	    $img_url = wp_get_attachment_url($id);
	    $is_intermediate = false;
	    $img_url_basename = wp_basename($img_url);

	    // try for a new style intermediate size
	    if ( $intermediate = image_get_intermediate_size($id, $size) ) {
	        $img_url = str_replace($img_url_basename, $intermediate['file'], $img_url);
	        $is_intermediate = true;
	    }
	    elseif ( $size == 'thumbnail' ) {
	        // Fall back to the old thumbnail
	        if ( ($thumb_file = wp_get_attachment_thumb_file($id)) && $info = getimagesize($thumb_file) ) {
	            $img_url = str_replace($img_url_basename, wp_basename($thumb_file), $img_url);
	            $is_intermediate = true;
	        }
	    }

	    // We have the actual image size, but might need to further constrain it if content_width is narrower
	    if ( $img_url) {
	        return array( $img_url, 0, 0, $is_intermediate );
	    }
	    return false;
	}
}
add_filter( 'image_downsize', 'myprefix_image_downsize', 1, 3 );


// REMOVE thumbnail dimensions from Image Attachement

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

// Removes attached image sizes as well
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );


function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


//----------------------------------------------------------------------------
	// GALLERY Tweaks

	/* Filter the post gallery shortcode output. */
	add_filter( 'post_gallery', 'responsive_gallery', 10, 2 );

	/**
	 * Overwrites the default WordPress [gallery] shortcode's output.  This function removes the invalid
	 * HTML and inline styles.  It adds the number of columns used as a class attribute, which allows
	 * developers to style the gallery more easily.
	 *
	 * @since 0.9.0
	 * @param string $output
	 * @param array $attr
	 * @return string $output
	 */
	function responsive_gallery( $output, $attr ) {
		global $post;

		static $responsive_gallery_instance = 0;
		$responsive_gallery_instance++;

		/* We're not worried abut galleries in feeds, so just return the output here. */
		if ( is_feed() )
			return $output;

		/* Orderby. */
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		/* Default gallery settings. */
		$defaults = array(
			'order' => 'ASC',
			'orderby' => 'menu_order ID',
			'id' => $post->ID,
			'link' => '',
			'itemtag' => 'div',
			'icontag' => 'div',
			'captiontag' => 'dd',
			'columns' => 3,
			'size' => 'medium',
			'include' => '',
			'exclude' => '',
			'numberposts' => -1,
			'offset' => ''
		);

		/* Apply filters to the default arguments. */
		$defaults = apply_filters( 'responsive_gallery_defaults', $defaults );

		/* Merge the defaults with user input. Make sure $id is an integer. */
		$attr = shortcode_atts( $defaults, $attr );
		extract( $attr );
		$id = intval( $id );

		/* Arguments for get_children(). */
		$children = array(
			'post_parent' => $id,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $order,
			'orderby' => $orderby,
			'exclude' => $exclude,
			'include' => $include,
			'numberposts' => $numberposts,
			'offset' => $offset,
		);

		/* Get image attachments. If none, return. */
		$attachments = get_children( $children );

		if ( empty( $attachments ) )
			return '';

		/* Properly escape the gallery tags. */
		$itemtag = tag_escape( $itemtag );
		$icontag = tag_escape( $icontag );
		$captiontag = tag_escape( $captiontag );
		$i = 0;

		/* Count the number of attachments returned. */
		$attachment_count = count( $attachments );

		/* Allow developers to overwrite the number of columns. This can be useful for reducing columns with with fewer images than number of columns. */
		//$columns = ( ( $columns <= $attachment_count ) ? intval( $columns ) : intval( $attachment_count ) );
		$columns = apply_filters( 'responsive_gallery_columns', intval( $columns ), $attachment_count, $attr );

		/* Open the gallery <div>. */
		$output = "\n\t\t\t<div id='gallery-{$id}-{$responsive_gallery_instance}' class='make-gallery line gallery-{$id}'>";

		/* Loop through each attachment. */
		foreach ( $attachments as $id => $attachment ) {

			/* Open each gallery row. */
			if ( $columns > 0 && $i % $columns == 0 )

			/* Open the element to wrap the image. */
		$output .= "\n\t\t\t\t\t\t<{$icontag} class='gallery-icon col-{$columns}'>";

		//$size .= " wow";

			/* Add the image. */
			$image = ( ( isset( $attr['link'] ) && 'file' == $attr['link'] ) ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false ) );
			$output .= apply_filters( 'responsive_gallery_image', $image, $id, $attr, $responsive_gallery_instance );

			/* Close the image wrapper. */
		$output .= "</{$icontag}>";

		}

		$output .= "\n\t\t\t</div><!-- .make-gallery -->\n";

		/* Return out very nice, valid HTML gallery. */
		return $output;
	}

//----------------------------------------------------------------------------
	// Craft attributes in the WP Gallery anchor tags


	add_filter('wp_get_attachment_link', 'add_gallery_link_attributes');
	function add_gallery_link_attributes($link) {
		global $post;
		return str_replace('<a href', '<a class="fresco" data-fresco-group="mixed" href', $link);
	}

//----------------------------------------------------------------------------
	// Change image classes in the_content

	/*
	add_filter('the_content', 'remove_img_titles');

	function remove_img_titles($class) {

	    // Get all title="..." tags from the html.
	    $result = array();
	    preg_match_all('|class="[^"]*"|U', $class, $result);

	    // Replace all occurances with an empty string.
	    foreach($result[0] as $img_tag) {
	        $class = str_replace($img_tag, 'class=fresco', $class);
	    }

	    return $class;
	}
	*/


add_filter( 'wp_get_attachment_link' , 'add_lighbox_rel' );
function add_lighbox_rel( $attachment_link ) {
	if( strpos( $attachment_link , 'a href') != false && strpos( $attachment_link , 'img src') != false )
		$attachment_link = str_replace( 'a href' , 'a rel="lightbox" href' , $attachment_link );
	return $attachment_link;
}

//----------------------------------------------------------------------------
	// No more jumping for read more link

	function no_more_jumping($post) {
		return '<a href="'.get_permalink().'" class="read-more margin-tb">'.' Read More'.'</a>';
	}
	add_filter('the_content_more_link', 'no_more_jumping');

//----------------------------------------------------------------------------

	//Increase upload size

	//	@ini_set( 'upload_max_size' , '64M' );
	//	@ini_set( 'post_max_size', '64M');
	//	@ini_set( 'max_execution_time', '300' );

//----------------------------------------------------------------------------

	// This theme uses wp_nav_menu()

	add_action( 'init', 'ceam13_register_menus' );

	function ceam13_register_menus() {
		register_nav_menus(
			array(
				'primary-menu' => __( 'mainNav' )  //mainNav
				//'secondary-menu' => __( 'Secondary Menu' ),
				//'tertiary-menu' => __( 'Tertiary Menu' )
			)
		);
	}

//----------------------------------------------------------------------------
	// ADD Custom Post Types to RSS feed

	function myfeed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
	}
	add_filter('request', 'myfeed_request');

//----------------------------------------------------------------------------
	// <figure> formatting for images

/*

	add_shortcode('wp_caption', 'ceam13_img_caption_shortcode');
	add_shortcode('caption', 'ceam13_img_caption_shortcode');

	function ceam13_img_caption_shortcode($attr, $content = null) {

	extract(shortcode_atts(array(
	'id'    => '',
	'align'    => 'alignnone',
	'width'    => '',
	'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
	return $content;

	if ( $id ) $idtag = 'id="' . esc_attr($id) . '" ';

	  return '<figure ' . $idtag . 'aria-describedby="figcaption_' . $id . '" style="width: ' . (10 + (int) $width) . 'px">'
	  . do_shortcode( $content ) . '<figcaption id="figcaption_' . $id . '">' . $caption . '</figcaption></figure>';
	}
*/

//----------------------------------------------------------------------------

	// Enqueue Scripts

	function run_js() {
		if (!is_admin()) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, false);
				//wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, false);

				wp_enqueue_script('jquery');

				if (is_home()) {
					//wp_enqueue_script('royal', get_bloginfo('template_url') . '/lib/js/royal/royalslider/jquery.royalslider.min.js', array('jquery'), '1.0', true);

					//wp_enqueue_script('stretch', get_bloginfo('template_url') . '/lib/js/anystretch/jquery.anystretch.min.js', array('jquery'), '1.0', true);

					//wp_enqueue_script('home', get_bloginfo('template_url') . '/lib/js/home.js', array('jquery'), '1.0', true);
					}


				if (is_single("7049")) {

					wp_enqueue_script('hogan', get_bloginfo('template_url') . '/lib/js/hogan/lib/hogan.js', array('jquery'), '1.0', true);
					wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/lib/js/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


					wp_enqueue_script('msip5', get_bloginfo('template_url') . '/lib/js/msip5/msip5.js', array('jquery'), '1.0', true);
					}


				if (is_single("7466")) {

					wp_enqueue_script('hogan', get_bloginfo('template_url') . '/lib/js/hogan/lib/hogan.js', array('jquery'), '1.0', true);
					wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/lib/js/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


					wp_enqueue_script('msip5_2014', get_bloginfo('template_url') . '/lib/js/msip5/msip5_2014.js', array('jquery'), '1.0', true);
					}


				if (is_single("7782")) {

					wp_enqueue_script('hogan', get_bloginfo('template_url') . '/lib/js/hogan/lib/hogan.js', array('jquery'), '1.0', true);
					wp_enqueue_script('typeahead', get_bloginfo('template_url') . '/lib/js/typeahead/typeahead.min.js', array('jquery'), '1.0', true);


					wp_enqueue_script('superintendant', get_bloginfo('template_url') . '/lib/js/typeahead/superintendant-information.js', array('jquery'), '1.0', true);
					}


				if (is_single()) {
					//wp_enqueue_script('msip5', get_bloginfo('template_url') . '/lib/js/msip5/msip5.js', array('jquery'), '1.0', true);

					//wp_enqueue_script('fresco', get_bloginfo('template_url') . '/lib/js/fresco/js/fresco/fresco.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('fancybox', get_bloginfo('template_url') . '/lib/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('lazy', get_bloginfo('template_url') . '/lib/js/jquery.lazyload.mini.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('audio', get_bloginfo('template_url') . '/lib/js/audiojs/audio.min.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('textarea', get_bloginfo('template_url') . '/lib/js/jquery.expandable.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('single', get_bloginfo('template_url') . '/lib/js/single.js', array('jquery'), '1.0', true);
					}

				if (is_page('archive')) {
					//wp_enqueue_script('liveFilter', get_bloginfo('template_url') . '/lib/js/jquery.liveFilter.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('inFieldLabels', get_bloginfo('template_url') . '/lib/js/jquery.infieldlabel.min.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('archive', get_bloginfo('template_url') . '/lib/js/archive.js', array('jquery'), '1.0', true);
					}

				if (is_page('contact')) {
					//wp_register_script('gmapAPI', 'http://maps.google.com/maps/api/js?sensor=false', false, false);
					//wp_enqueue_script('gmap3', get_bloginfo('template_url') . '/lib/js/gmap3.min.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('inFieldLabels', get_bloginfo('template_url') . '/lib/js/jquery.infieldlabel.min.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('textarea', get_bloginfo('template_url') . '/lib/js/jquery.expandable.js', array('jquery'), '1.0', true);
					//wp_enqueue_script('contact', get_bloginfo('template_url') . '/lib/js/contact.js', array('jquery'), '1.0', true);
					}
				}
			}

	add_action('wp_print_scripts', 'run_js');

	// Add this function call for RoyalSlider to work on the homepage
	
	// register_new_royalslider_files(1);

//----------------------------------------------------------------------------

// CUSTOM POST TYPES

	add_action( 'init', 'ceam13_post_types' );

	function ceam13_post_types() {

	//STAFF
			register_post_type( 'cpt_staff',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Staff' ),
					'singular_name' => __( 'Staff' ),
					'add_new' => __( 'Add New Staff' ),
					'add_new_item' => __( 'Add New Staff' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Staff' ),
					'new_item' => __( 'New Staff' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Staff' ),
					'search_items' => __( 'Search Staff' ),
					'not_found' => __( 'No Staff found' ),
					'not_found_in_trash' => __( 'No Staff found in Trash' ),
					'parent' => __( 'Parent Staff' ),
				),
				'description' => __( 'CEAM Staff' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title', 'editor', 'thumbnail' ),

				'rewrite' => array( 'slug' => 'staff', 'with_front' => false ), //  slug: The slug you�d like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'category', 'feature_type') // 'albumtype', 'post_tag'
				)
			);

	//BOARD OF DIRECTORS
			register_post_type( 'cpt_board',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Board' ),
					'singular_name' => __( 'Board of Directors' ),
					'add_new' => __( 'Add New Board Memeber' ),
					'add_new_item' => __( 'Add New Board Memeber' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Board Memeber' ),
					'new_item' => __( 'New Board Memeber' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Board Memeber' ),
					'search_items' => __( 'Search Board Memeber' ),
					'not_found' => __( 'No Board Memebers found' ),
					'not_found_in_trash' => __( 'No Board Memebers found in Trash' ),
					'parent' => __( 'Parent Board Memeber' ),
				),
				'description' => __( 'CEAM Board Memebers' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title', 'editor', 'thumbnail' ),

				'rewrite' => array( 'slug' => 'board-member', 'with_front' => false ), //  slug: The slug you�d like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'post_tag', 'category')
				)
			);

	//FEATURE
			register_post_type( 'feature',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Home Feature' ),
					'singular_name' => __( 'Feature' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Feature' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Feature' ),
					'new_item' => __( 'New Feature' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Feature' ),
					'search_items' => __( 'Search Feature' ),
					'not_found' => __( 'No Feature found' ),
					'not_found_in_trash' => __( 'No Feature found in Trash' ),
					'parent' => __( 'Parent Feature' ),
				),
				'description' => __( 'Features' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments' ),

				'rewrite' => array( 'slug' => 'feature', 'with_front' => false ), //  slug: The slug you�d like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'post_tag', 'category')
				)
			);

	//Events
			register_post_type( 'cpt_events',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Events' ),
					'singular_name' => __( 'Event' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Event' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Event' ),
					'new_item' => __( 'New Event' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Event' ),
					'search_items' => __( 'Search Events' ),
					'not_found' => __( 'No Events found' ),
					'not_found_in_trash' => __( 'No Events found in Trash' ),
					'parent' => __( 'Parent Event' ),
				),
				'description' => __( 'Events' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title'),

				'rewrite' => array( 'slug' => 'event', 'with_front' => false ), //  slug: The slug you�d like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'post_tag', 'category')
				)
			);

	//RESOURCES
			register_post_type( 'cpt_resources',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Resources' ),
					'singular_name' => __( 'Resource' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Resource' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Resource' ),
					'new_item' => __( 'New Resource' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Resource' ),
					'search_items' => __( 'Search Resources' ),
					'not_found' => __( 'No Resources found' ),
					'not_found_in_trash' => __( 'No Resources found in Trash' ),
					'parent' => __( 'Parent Resource' ),
				),
				'description' => __( 'Resources' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments' ),

				'rewrite' => array( 'slug' => 'resources', 'with_front' => false ), //  slug: The slug you�d like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'post_tag', 'category')
				)
			);

	//TESTIMONIALS
			register_post_type( 'cpt_testimonial',	//NO Capital Letters - NO Spaces (You can use underscores)
			array(
				'labels' => array(
					'name' => __( 'Testimonial' ),
					'singular_name' => __( 'Testimonial' ),
					'add_new' => __( 'Add New Testimonial' ),
					'add_new_item' => __( 'Add New Testimonial' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Testimonial' ),
					'new_item' => __( 'New Testimonial' ),
					'view' => __( 'View' ),
					'view_item' => __( 'View Testimonial' ),
					'search_items' => __( 'Search Testimonial' ),
					'not_found' => __( 'No Testimonial found' ),
					'not_found_in_trash' => __( 'No Testimonial found in Trash' ),
					'parent' => __( 'Parent Testimonial' ),
				),
				'description' => __( 'CEAM Testimonial' ),
				'public' => true,
				'show_ui' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,

				'menu_position' => 20, // WordPress menu items are set apart by integrals of 5. For example, using 20 will add your menu item after Pages.
				//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png', //Default is Posts menu icon,  you can define a custom icon.
				'hierarchical' => false, // true = pages | false = posts
				'query_var' => true, // The query_var argument allows you to control the query variable used to get posts of this type.
				'supports' => array( 'title', 'editor', 'thumbnail' ),

				'rewrite' => array( 'slug' => 'testimonials', 'with_front' => false ), //  slug: The slug you'd like to prefix your posts with. // with_front: Whether your post type should use the front base from your permalink settings (for example, if you prefixed your structure with /blog or /archives).

				'taxonomies' => array( 'category', 'feature_type') // 'albumtype', 'post_tag'
				)
			);


		} //End


//----------------------------------------------------------------------------

//CUSTOM TAXONOMIES


	//MUSIC TYPE custom taxonomy

	add_action( 'init', 'feature_taxonomy' );
	function feature_taxonomy() {
		register_taxonomy(
			'feature_type',
			array( 'cpt_local_stuff' ), // Post Type  'music',	'cars',
			array(
				'hierarchical' => true,
				'label' => 'Feature Type',
				'query_var' => true,
				'rewrite' => array('slug' => 'feature-type')
			)
		);
    }

/*
	//MUSIC TYPE custom taxonomy

	add_action( 'init', 'music_taxonomy' );
	function music_taxonomy() {
		register_taxonomy(
			'musictype',
			array( 'post' ), // Post Type  'music',	'cars',
			array(
				'hierarchical' => true,
				'label' => 'Album Type',
				'query_var' => true,
				'rewrite' => array('slug' => 'music-type')
			)
		);
    }

*/


//----------------------------------------------------------------------------

	//COMMENT LIST FORMATING

	function ceam13_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<div id="comment-<?php comment_ID(); ?>" class="line comment-margin">

			<div class="comment-author vcard unit size1of6 pt1">
				<p><?php printf(/* __( '%s <span class="says">says:</span>', 'ceam13' ),*/ sprintf( '<cite class="bold">%s</cite>', get_comment_author_link() ) ); ?>

					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date em0"><?php printf( __( '%1$s <br> %2$s', 'ceam13' ), get_comment_date('M j, Y '),  get_comment_time() ); ?></a>
				</p>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'ceam13' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-body unit size4of6">

				<?php comment_text(); ?>
				<p class="reply line pad1to1">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( '(Edit)', 'ceam13' ), ' ' ); ?>
				</p><!-- .reply -->
			</div>

			<div class="comment-meta commentmetadata lastUnit size1of6 pt1">
				<p><?php echo get_avatar( $comment, 55 ); ?></p>
			</div><!-- .comment-meta .commentmetadata -->

		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ceam13' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ceam13'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
	}

//----------------------------------------------------------------------------

	// SHOW FUTURE POSTS (on singular page)

	add_filter('the_posts', 'show_future_posts');

	function show_future_posts($posts)
	{
	   global $wp_query, $wpdb;

	   if(is_single() && $wp_query->post_count == 0)
	   {
	      $posts = $wpdb->get_results($wp_query->request);
	   }

	   return $posts;
	}


//----------------------------------------------------------------------------

	//Adds Post Thumbnail to Page/Post Overview

	if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {

		// for post and page
		//add_theme_support('post-thumbnails', array( 'post', 'page' ) );

		function fb_AddThumbColumn($cols) {

			$cols['thumbnail'] = __('Thumbnail');

			return $cols;
		}

		function fb_AddThumbValue($column_name, $post_id) {

				$width = (int) 35;
				$height = (int) 35;

				if ( 'thumbnail' == $column_name ) {
					// thumbnail of WP 2.9
					$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
					// image from gallery
					$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
					if ($thumbnail_id)
						$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
					elseif ($attachments) {
						foreach ( $attachments as $attachment_id => $attachment ) {
							$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
						}
					}
						if ( isset($thumb) && $thumb ) {
							echo $thumb;
						} else {
							echo __('None');
						}
				}
		}

		// for posts
		add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
		add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );

		// for pages
		add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
		add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
	}

//----------------------------------------------------------------------------

	// COPYRIGHT

	function add_copyright() {
	    global $wpdb;
	    $copyright_dates = $wpdb->get_results("
	    SELECT
	    YEAR(min(post_date_gmt)) AS firstdate,
	    YEAR(max(post_date_gmt)) AS lastdate
	    FROM
	    $wpdb->posts
	    WHERE
	    post_status = 'publish'
	    ");
	    $output = '';
	    if($copyright_dates) {
	    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
	    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	    $copyright .= '-' . $copyright_dates[0]->lastdate;
	    }
	    $output = $copyright;
	    }
	    return $output;
	}

//----------------------------------------------------------------------------

	// ADMIN PAGE LOGO

	function custom_admin_logo() {
	  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/lib/style/WP/admin-style.css" />';
	}

	add_action('admin_head', 'custom_admin_logo');


//-------------------------------------------------------------------

	// LOGIN PAGE STYLE

	function custom_login_css() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/lib/style/WP/login-style.css" />';
	 	}

	add_action('login_head', 'custom_login_css');

//-------------------------------------------------------------------

	// Get Or Print Any Custom Field Value Easily With A Custom Function

	function get_custom_field_value($cfKey, $cfPrint = false) {
		global $post;
		$cfValue = get_post_meta($post->ID, $cfKey, true);
		if ( $cfPrint == false ) return $cfValue; else echo $cfValue;
	}
//-------------------------------------------------------------------

	//Custom Dashboard Widget

	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

	function my_custom_dashboard_widgets() {
		global $wp_meta_boxes;

		wp_add_dashboard_widget('custom_help_widget', 'Tech Support', 'custom_dashboard_help');
	}

	function custom_dashboard_help() {
		echo '<p>This is the administration page for this site. Need help, or did you find a bug? <a href="mailto:info@solvm.com">Contact the developer here</a>.</p>';
	}

//----------------------------------------------------------------------------

	// Remove menu items

function remove_menu_items() {
  global $menu;
  $restricted = array( __('Links')); //$restricted = array(__('Posts'), __('Links'), __('Comments'), __('Media'),__('Plugins'), __('Tools'), __('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');




//-------------------------------------------------------------------

	//Connecting posts (relationships)
	//https://github.com/scribu/wp-posts-to-posts/wiki

/*
	function my_connection_types() {
		// Make sure the Posts 2 Posts plugin is active.
		if ( !function_exists( 'p2p_register_connection_type' ) )
			return;

		p2p_register_connection_type( array(
			'name' => 'posts_to_pages',
			'from' => 'rbab_events',
			'to' => 'rbab_speakers',
			'admin_column' => 'any'
		) );
	}
	add_action( 'wp_loaded', 'my_connection_types' );

*/

//----------------------------------------------------------------------------

	//META BOX

	include 'lib/metabox/meta-boxes.php';
	//include 'metabox/demo.php';

//----------------------------------------------------------------------------


//----------------------------------------------------------------------------

	// This theme styles the visual editor with editor-style.css to match the theme style.

		add_editor_style('lib/style/css/custom.css');

	// Tiny MCE

/**
 * Apply styles to the visual editor
 */
	add_filter('mce_css', 'tuts_mcekit_editor_style');
	function tuts_mcekit_editor_style($url) {
	    if ( !empty($url) )
	        $url .= ',';
	    // Retrieves the plugin directory URL
	    // Change the path here if using different directories
	    $url .= get_bloginfo('template_url').'/lib/style/css/custom.css';
	    return $url;
	}
	/**
	 * Add "Styles" drop-down
	 */
	add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
	function tuts_mce_editor_buttons( $buttons ) {
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	/**
	 * Add styles/classes to the "Styles" drop-down
	 */
	add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
	function tuts_mce_before_init( $settings ) {
	    $style_formats = array(
	        array(
	            'title' => 'Section heading',
	            'block' => 'h2',
	            'classes' => 'sectionhead'
	            ),
	       array(
	            'title' => 'Sub-heading',
	            'block' => 'h3',
	            'classes' => 'subhead'
	        ),
	        array(
	            'title' => 'Statement',
	            'block' => 'h3',
	            'classes' => 'statement'
	        ),
	        array(
	            'title' => 'Button',
	            'selector' => 'a',
	            'classes' => 'button'
	        )
	        /*

	        array(
	            'title' => 'Warning Box',
	            'block' => 'div',
	            'classes' => 'warning box',
	            'wrapper' => true
	        ),
	        array(
	            'title' => 'Red Uppercase Text',
	            'inline' => 'span',
	            'styles' => array(
	                'color' => '#ff0000',
	                'fontWeight' => 'bold',
	                'textTransform' => 'uppercase'
	            )
	        )
	        */
	    );
	    $settings['style_formats'] = json_encode( $style_formats );
	    return $settings;
	}
	/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
	/*
	 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
	 * http://www.tomjn.com/150/typekit-wp-editor-styles/
	 */
	add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
	/*
	 * Enqueue stylesheet, if it exists.
	 */
	function tuts_mcekit_editor_enqueue() {
	  if (is_admin()) { //only load if is ADMIN pages
		  $StyleUrl = get_bloginfo('template_url').'/lib/style/css/custom.css'; // Customstyle.css is relative to the current file
		  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
		  }
	}


//Enable TYPEKIT in Editor
add_filter("mce_external_plugins", "tomjn_mce_external_plugins");
function tomjn_mce_external_plugins($plugin_array){
	$plugin_array['typekit']  =  get_template_directory_uri().'/lib/js/typekit-tinymce.js';
    return $plugin_array;
}


//----------------------------------------------------------------------------

	//OPTIONS PAGE


/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

	if ( !function_exists( 'of_get_option' ) ) {
		function of_get_option($name, $default = 'false') {

			$optionsframework_settings = get_option('optionsframework');

			// Gets the unique option id
			$option_name = $optionsframework_settings['id'];

			if ( get_option($option_name) ) {
				$options = get_option($option_name);
			}

			if ( !empty($options[$name]) ) {
				return $options[$name];
			} else {
				return $default;
			}
		}
	}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

	add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

	function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('#example_showhidden').click(function() {
	  		jQuery('#section-example_text_hidden').fadeToggle(400);
		});

		if (jQuery('#example_showhidden:checked').val() !== undefined) {
			jQuery('#section-example_text_hidden').show();
		}

	});
	</script>

<?php
	}
}
?>
