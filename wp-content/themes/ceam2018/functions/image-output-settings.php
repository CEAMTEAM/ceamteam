<?php


// Disable WordPress Responsive Images
// https://perishablepress.com/disable-wordpress-responsive-images/
add_filter('max_srcset_image_width', create_function('', 'return 1;'));


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





// http://coolestguidesontheplanet.com/responsively-removing-width-and-height-attributes-in-images-on-wordpress/

// Touch up with a little CSS
// div.wp-caption { max-width: 100%; }

add_shortcode( 'wp_caption', 'fixed_img_caption_shortcode' );
add_shortcode( 'caption', 'fixed_img_caption_shortcode' );

function fixed_img_caption_shortcode($attr, $content = null) {
     if ( ! isset( $attr['caption'] ) ) {
         if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
         $content = $matches[1];
         $attr['caption'] = trim( $matches[2] );
         }
     }
     $output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
         if ( $output != '' )
         return $output;
     extract( shortcode_atts(array(
     'id'      => '',
     'align'   => 'alignnone',
     'width'   => '',
     'caption' => ''
     ), $attr));
     if ( 1 > (int) $width || empty($caption) )
     return $content;
     if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
     return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
     . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

?>
