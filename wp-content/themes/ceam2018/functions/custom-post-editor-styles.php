<?php
// This theme styles the visual editor
// http://www.carriedils.com/add-editor-style/

add_action( 'init', 'add_editor_styles' );
function add_editor_styles() {
  add_editor_style( get_stylesheet_uri() );
}


// Apply styles to the visual editor
add_filter('mce_css', 'mcekit_editor_style');
function mcekit_editor_style($url) {
  if ( !empty($url) )
    $url .= ',';
    $url .= get_stylesheet_uri();
  return $url;
}


// Add "Styles" drop-down
add_filter( 'mce_buttons', 'mce_editor_buttons' );
function mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect', 'removeformat' );
    return $buttons;
}


// Add styles/classes to the "Styles" drop-down
add_filter( 'tiny_mce_before_init', 'mce_before_init' );
function mce_before_init( $settings ) {
  $style_formats = array(
    array(
      'title' => 'Cursive heading',
      'block' => 'h2',
      'classes' => 'cpe__heading'
    ),
    array(
      'title' => 'Normal heading',
      'block' => 'h3',
      'classes' => 'cpe__subheading'
    )
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}

function theme_add_editor_styles(){
  $styleUrl = get_bloginfo('template_url').'/style.css';
  add_editor_style( $styleUrl );
}
add_action( 'init', 'theme_add_editor_styles' );



//Removes buttons from the first row (kitchen sink) of the tiny mce editor
// http://thestizmedia.com/remove-buttons-items-wordpress-tinymce-editor/
add_filter( 'mce_buttons', 'jivedig_remove_tiny_mce_buttons_from_editor');
function jivedig_remove_tiny_mce_buttons_from_editor( $buttons ) {
  $remove_buttons = array(
    //'bold',
    //'italic',
    'strikethrough',
    //'bullist',
    //'numlist',
    'blockquote',
    //'hr', // horizontal line
    'alignleft',
    'aligncenter',
    'alignright',
    //'link',
    'unlink',
    'wp_more', // read more link
    'spellchecker',
    //'dfw', // distraction free writing mode
    'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
    'formatselect'
  );
  foreach ( $buttons as $button_key => $button_value ) {
    if ( in_array( $button_value, $remove_buttons ) ) {
      unset( $buttons[ $button_key ] );
    }
  }
  return $buttons;
}

//Removes buttons from the second row (kitchen sink) of the tiny mce editor
// http://thestizmedia.com/remove-buttons-items-wordpress-tinymce-editor/
add_filter( 'mce_buttons_2', 'jivedig_remove_tiny_mce_buttons_from_kitchen_sink');
function jivedig_remove_tiny_mce_buttons_from_kitchen_sink( $buttons ) {
  $remove_buttons = array(
    'underline',
    'alignjustify',
    //'forecolor', // text color
    'pastetext', // paste as text
    //'removeformat', // clear formatting
    'charmap', // special characters
    //'outdent',
    //'indent',
    'undo',
    'redo',
    'wp_help', // keyboard shortcuts
    'formatselect' // format dropdown menu for <p>, headings, etc
  );
  foreach ( $buttons as $button_key => $button_value ) {
    if ( in_array( $button_value, $remove_buttons ) ) {
      unset( $buttons[ $button_key ] );
    }
  }
  return $buttons;
}


// Add TYPEKit to WP Editor
add_filter( 'mce_external_plugins', 'my_theme_mce_external_plugins' );
function my_theme_mce_external_plugins( $plugin_array ) {
	$plugin_array['typekit'] = get_template_directory_uri() . '/js/vendor/typekit.tinymce.js';
	return $plugin_array;
}
