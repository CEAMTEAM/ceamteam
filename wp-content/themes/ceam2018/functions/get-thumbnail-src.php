<?php
// http://code.tutsplus.com/articles/writing-better-apis-and-libraries-for-wordpress--wp-33601

// Get Thumb
function get_thumbnail_src( $post = false )
{
  if (  false === $post ) {
    $post = get_the_ID();
  } else if ( is_object( $post ) && isset( $post->ID ) ) {
    $post = $post->ID;
  } else if ( is_array( $post ) && isset( $post['ID'] ) ) {
    $post = $post['ID'];
  }

  $thumb_id = get_post_thumbnail_id( $post );
  $thumb = wp_get_attachment_thumb_url( $thumb_id );

  return $thumb;
}

// Usage
// echo '<img src="'.get_thumbnail_src().'" />';




// Modified to get FULL Image

function get_full_image_src( $post = false )
{
  if ( false === $post ) {
    $post = get_the_ID();
  } else if ( is_object( $post ) && isset( $post->ID ) ) {
    $post = $post->ID;
  } else if ( is_array( $post ) && isset( $post['ID'] ) ) {
    $post = $post['ID'];
  }

  $thumb_id = get_post_thumbnail_id( $post );
  $full = wp_get_attachment_url( $thumb_id );

  return $full;
}

// Usage
// echo '<img src="'.get_full_image_src().'" />';

?>
