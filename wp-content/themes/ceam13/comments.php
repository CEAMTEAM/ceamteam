<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to play_comment which is
 * located in the functions.php file.
 *
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ceam13' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

		<h3 id="comments-title"><?php
		printf( _n( 'One Comment %2$s', '%1$s Comments %2$s', get_comments_number(), 'ceam13' ),
		number_format_i18n( get_comments_number() ), '' );
		?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'ceam13' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'ceam13' ) ); ?></div>
		</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

		<ol class="commentlist pb3">
			<?php wp_list_comments( array( 'callback' => 'ceam13_comment' ) ); ?>
		</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'ceam13' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'ceam13' ) ); ?></div>
		</div><!-- .navigation -->

<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'ceam13' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php
 	/*Customize comment form here
	comment_form(array('comment_notes_before'=>'','comment_notes_after'=>'','comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">' . __( 'Comment' ) . '</label>' .
                '<textarea id="comment" name="comment" tabindex="4" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->'));
    */
	?>

<?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(



    'author' => '<div class="comment-form-author unit size1of3">' .
	    			'<p>'.
		                '<label for="author">' . __( 'Name' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		                '<input maxlength="60" class="full" id="author" name="author" type="text" value="' .
		                esc_attr( $commenter['comment_author'] ) . '" tabindex="1" />' .
	                '</p>'.
                '</div><!-- #form-section-author .form-section -->',

    'email'  => '<div class="comment-form-email unit size1of3">' .
	    			'<p>'.
		                '<label for="email">' . __( 'Email' ) .  ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		                '<input type="email" maxlength="60" class="full" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2" />' .
	                '</p>'.
                '</div><!-- #form-section-email .form-section -->',

    'url'    => '<div class="comment-form-url unit size1of3">' .
	    			'<p>'.
		                '<label for="url">' . __( 'Website' ) . '</label>' .
		                '<input type="url" maxlength="60" class="full" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" />' .
	                '</p>'.
                '</div><!-- #form-section-url .form-section -->' ) ),

    'comment_field' => '<div class="comment-form-comment clear">' .
    			'<p>'.
                '<label for="comment">' . __( 'Comment' ) . '</label>' .
                '<textarea class="full" id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</p>'.
                '</div><!-- #form-section-comment .form-section -->',

    'comment_notes_before'	=>'',
    'comment_notes_after'	=>'',
    'id_form'			 	=> 'commentform',

    'id_submit' 			=> 'submit',
    'title_reply' 			=> __( 'Leave a Reply' ),
    'title_reply_to'		=> __( 'Leave a Reply to %s' ),
    'cancel_reply_link' 	=> __( 'Cancel reply' ),
    'label_submit' 			=> __( 'Post Comment' )

);

comment_form($comment_args); ?>

</div><!-- #comments -->
