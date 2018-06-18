<?php
/*
Plugin Name: idbbee
Plugin URI: https://wordpress.org/plugins/idbbee/
Description: [idbbee src="//thyme.dbbee.com/u/demo/" width="100%" height="600"] shortcode
Version: 1.0
Author: dbBee.com
Author URI: http://www.dbbee.com/
License: GPLv3
*/


function idbbee_embed_shortcode( $atts, $content = null ) {
	$defaults = array(
		'src' => '//thyme.dbbee.com/u/demo/',
		'width' => '100%',
		'height' => '600',
	        'id' => 'dbBeeIFrame',
                'name' => 'dbBeeIFrame',
                'border' => '0',
		'frameborder' => '0',
                'marginwidth' => '0',
                'marginheight' => '0',
		'class' => 'dbBeeIFrameclass'
	);

	foreach ( $defaults as $default => $value ) {
		if ( ! @array_key_exists( $default, $atts ) ) {
			$atts[$default] = $value;
		}
	}
	$dbbeecode = "\n".'<!-- dbBee iframe plugin v.1.0 https://wordpress.org/plugins/idbbee/ -->'."\n";
	$dbbeecode .= '<iframe';
	foreach( $atts as $attr => $value ) {
			if ( $value != '' ) {
				$dbbeecode .= ' ' . $attr . '="' . $value . '"';
			} else {
				$dbbeecode .= ' ' . $attr;
			}
	}
	$dbbeecode .= '></iframe>'."\n";
	return $dbbeecode;
}
add_shortcode( 'idbbee', 'idbbee_embed_shortcode' );
function idbbee_plugin_meta( $links, $file ) {
	if ( strpos( $file, 'idbbee.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="http://www.dbbee.com/" target="_dbBee" title="dbBee Service">dbBee</a>' ) );
		$links = array_merge( $links, array( '<a href="https://thyme.dbbee.com/register/" target="_dbBee" title="Create free account">Register</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.dbbee.com/plans" target="_dbBee" title="See available plans">Plans</a>' ) );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'idbbee_plugin_meta', 10, 2 );