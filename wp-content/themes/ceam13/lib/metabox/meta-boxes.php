<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them CAREFULLY
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/**
 * Add field type: 'taxonomy'
 *
 * Note: The class name must be in format "RWMB_{$field_type}_Field"
 */
if ( !class_exists( 'RWMB_Taxonomy_Field' ) ) {
	class RWMB_Taxonomy_Field {

		/**
		 * Add default value for 'taxonomy' field
		 * @param $field
		 * @return array
		 */
		static function normalize_field( $field ) {
			// Default query arguments for get_terms() function
			$default_args = array(
				'hide_empty' => false
			);
			if ( !isset( $field['options']['args'] ) )
				$field['options']['args'] = $default_args;
			else
				$field['options']['args'] = wp_parse_args( $field['options']['args'], $default_args );

			// Show field as checkbox list by default
			if ( !isset( $field['options']['type'] ) )
				$field['options']['type'] = 'checkbox_list';

			// If field is shown as checkbox list, add multiple value
			if ( 'checkbox_list' == $field['options']['type'] )
				$field['multiple'] = true;

			return $field;
		}

		/**
		 * Get field HTML
		 * @param $html
		 * @param $field
		 * @param $meta
		 * @return string
		 */
		static function html( $html, $meta, $field ) {
			global $post;

			$options = $field['options'];

			$meta = wp_get_post_terms( $post->ID, $options['taxonomy'], array( 'fields' => 'ids' ) );
			$meta = is_array( $meta ) ? $meta : ( array ) $meta;
			$terms = get_terms( $options['taxonomy'], $options['args'] );

			$html = '';
			// Checkbox_list
			if ( 'checkbox_list' == $options['type'] ) {
				foreach ( $terms as $term ) {
					$html .= "<input type='checkbox' name='{$field['id']}[]' value='{$term->term_id}'" . checked( in_array( $term->term_id, $meta ), true, false ) . " /> {$term->name}<br/>";
				}
			}
			// Select
			else {
				$html .= "<select name='{$field['id']}" . ( $field['multiple'] ? "[]' multiple='multiple' style='height: auto;'" : "'" ) . ">";
				foreach ( $terms as $term ) {
					$html .= "<option value='{$term->term_id}'" . selected( in_array( $term->term_id, $meta ), true, false ) . ">{$term->name}</option>";
				}
				$html .= "</select>";
			}

			return $html;
		}

		/**
		 * Save post taxonomy
		 * @param $post_id
		 * @param $field
		 * @param $old
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field ) {
			wp_set_post_terms( $post_id, $new, $field['options']['taxonomy'] );
		}
	}
}

/********************* META BOXES DEFINITION ***********************/

/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = 'tf_';

$meta_boxes = array( );


// TEAM meta box
$meta_boxes[] = array(
	'id' => 'staff',
	'title' => 'Staff Details',						// meta box title
	'pages' => array('cpt_staff'),					// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Title',						// field name
			//'desc' => 'enter speaker name like this (firstname-lastmname) example: jane-smith',				// field description, optional
			'id' => "{$prefix}title",				// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%'					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		)
	)
);

// BOARD DETAILS meta box
$meta_boxes[] = array(
	'id' => 'board',									// meta box id, unique per meta box
	'title' => 'Board details',							// meta box title
	'pages' => array('cpt_board'),					// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',								// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',								// order of meta box: high (default), low; optional

	'fields' => array(									// list of meta fields
		array(
			'name' => 'Board Title',							// field name
			//'desc' => 'Include http://',				// field description, optional
			'id' => $prefix . 'board_title',			// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Place of Work',							// field name
			//'desc' => 'Include http://',				// field description, optional
			'id' => $prefix . 'work',			// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Work Title',							// field name
			//'desc' => 'Include http://',				// field description, optional
			'id' => $prefix . 'work_title',			// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		)
	)
);


// ENGAGEMENT meta box
$meta_boxes[] = array(
	'id' => 'socialmedia',									// meta box id, unique per meta box
	'title' => 'Social Media',							// meta box title
	'pages' => array('cpt_local_stuff'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',							// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',								// order of meta box: high (default), low; optional

	'fields' => array(									// list of meta fields

		array(
			'name' => 'Twitter',						// field name
			'desc' => 'Include http://',				// field description, optional
			'id' => "{$prefix}twitter",		// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),

		array(
			'name' => 'Facebook',						// field name
			'desc' => 'Include http://',				// field description, optional
			'id' => "{$prefix}facebook",		// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Instagram',						// field name
			'desc' => 'Include http://',				// field description, optional
			'id' => "{$prefix}instagram",		// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),
	)
);

// EVENT DETAILS meta box
$meta_boxes[] = array(
	'id' => 'events',									// meta box id, unique per meta box
	'title' => 'Event info',							// meta box title
	'pages' => array('cpt_events'),					// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',								// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',								// order of meta box: high (default), low; optional

	'fields' => array(									// list of meta fields
		array(
			'name' => 'Event date',							// field name
			//'desc' => 'Include http://',				// field description, optional
			'id' => $prefix . 'event_date',			// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Event URL (from NationBuilder)',							// field name
			'desc' => 'Include http://',				// field description, optional
			'id' => $prefix . 'event_url',			// field id, i.e. the meta key
			'type' => 'text',							// text box
			//'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
			'style' => 'width: 100%',					// custom style for field, added in v3.1
			//'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
		)
	)
);


// EVENT DETAILS meta box
$meta_boxes[] = array(
  'id' => 'homeFeature',									// meta box id, unique per meta box
  'title' => 'Home Feature Settings',							// meta box title
  'pages' => array('feature'),					// post types, accept custom post types as well, default is array('post'); optional
  'context' => 'normal',								// where the meta box appear: normal (default), advanced, side; optional
  'priority' => 'high',								// order of meta box: high (default), low; optional

  'fields' => array(									// list of meta fields
    array(
      'name' => 'Big orange button URL',							// field name
      'desc' => 'Include http://',				// field description, optional
      'id' => $prefix . 'linkurl',			// field id, i.e. the meta key
      'type' => 'text',							// text box
      //'std' => 'Who is their Host? - Use QUIX - type whois / or ask client',					// default value, optional
      'style' => 'width: 100%',					// custom style for field, added in v3.1
      //'validate_func' => 'check_name'			// validate function, created below, inside RW_Meta_Box_Validate class
    )
  )
);


/**
 * Register meta boxes
 * Make sure there's no errors when the plugin is deactivated or during upgrade
 */
if ( class_exists( 'RW_Meta_Box' ) ) {
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
