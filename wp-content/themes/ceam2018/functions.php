<?php

add_action( 'after_setup_theme', 'custom_theme_setup' );
function custom_theme_setup() {

  // Clean up the header by removing wp bloat
  include 'functions/clean-head.php';

  //flush_rewrite_rules();

  // SUPPORTS - Post Thumbnail, etc.
  // WP Supports
  include 'functions/wp-supports.php';


  // REGISTRATIONS
   // Menus
  include 'functions/register-menus.php';


  // CUSTOM SETTINGS
  // Login Page Styles
  include 'functions/custom-login-page.php';
  // Post Editor Styles
  include 'functions/custom-post-editor-styles.php';
  // Get thumbnail function
  include 'functions/get-thumbnail-src.php';


  // IMAGE SETTINGS
  // Image Upload Settings
  // include 'functions/image-upload-settings.php';
  // Image Output Settings
  include 'functions/image-output-settings.php';


  // ENQUEUES
  //Enqueue Scripts
  include 'functions/enqueue-scripts.php';


  // ADVANCED CUSTOM FIELDS
  //Create Options page
  include 'functions/acf-options.php';


  // HOUSEKEEPING
  //Remove unneeded ui from Admin screen
  include 'functions/remove-menu-items.php';

  // Character Limit
  //LImit characters on excerpts
  include 'functions/character-limit.php';

  // Add page slug to body tag classList
  include 'functions/body-tag-slug.php';
}
