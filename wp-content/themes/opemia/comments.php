<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opemia
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<div class="posted-comments">
			<h3><?php echo esc_html__( 'Your Comments', 'opemia' ); ?></h3>

			<?php the_comments_navigation(); ?>

			<ul class="comments-list">
				<?php
				wp_list_comments(
					array(
						'short_ping' 	=> true,
						'style'			=> 'ul',
						'avatar_size' 	=> 100,
						'format'        => 'html5',
						'walker'        => new Opemia_Walker_Comment(),
						'type' => 'comment',
					)
				);
				?>
			</ul><!-- .comment-list -->

			<?php
			the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'opemia' ); ?></p>
				<?php
			endif;
			?>

		</div>
	<?php
	endif; // Check for have_comments().

	$commenter = wp_get_current_commenter();
	$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	if ( ! isset( $commenter['comment_author_number'] ) ) {
		$commenter['comment_author_number'] = '';
	}
	
	$fields = array(
		'author' 	=> '<div class="row"><div class="col-sm-6"><div class="form-group"><input class="form-control" id="author" name="author" type="text" placeholder="'. esc_attr__( 'Full Name', 'opemia' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div></div>',
		'email' 	=> '<div class="col-sm-6"><div class="form-group"><input class="form-control" id="email" name="email" type="text" placeholder="'. esc_attr__( 'Email', 'opemia' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div></div>',
		'url' 		=> '<div class="col-sm-6"><div class="form-group"><input class="form-control" id="url" name="url" type="text" placeholder="'. esc_attr__( 'Subject', 'opemia' ) .'" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" required="required" /></div></div>',
		'phone' 	=> '<div class="col-sm-6"><div class="form-group"><input class="form-control" id="phone" name="phone" type="number" placeholder="'. esc_attr__( 'Phone', 'opemia' ) .'" value="' . esc_attr(  $commenter['comment_author_number'] ) . '" required="required" /></div></div>',
		'comment'	=> '<div class="col-lg-12"><div class="form-group"><textarea class="form-control" id="comment" placeholder="'. esc_attr__( 'Your Message', 'opemia' ) .'" name="comment" rows="6" required="required"></textarea></div></div>',
		'cookies' 	=> '<div class="col-lg-12"><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'opemia' ) . '</label></p></div>',
	);

	if ( is_user_logged_in() ) {
		$comment_field = '<div class="row"><div class="col-lg-12"><div class="form-group"><textarea id="comment" placeholder="'. esc_attr__( 'Your Message', 'opemia' ) .'" class="form-control" name="comment" rows="6" required="required"></textarea></div></div>';
	} else {
		$comment_field = '<div class="col-lg-12"><div class="form-group"><textarea id="comment" placeholder="'. esc_attr__( 'Your Message', 'opemia' ) .'" class="form-control" name="comment" rows="6" required="required"></textarea></div></div>';
	}

	$args = array(
		'class_container'		=> 'post-comment-sec',
		'must_log_in'			=> '',
		'logged_in_as'			=> '',
		'class_submit'  		=> 'btn-default',
		'title_reply_before' 	=> '<h3 class="sc-title">',
		'title_reply_after' 	=> '</h3>',
		'comment_notes_before' 	=> sprintf( '<span>%s</span>', esc_html__( 'Please sing in to post your comment or singup if you dont have account.', 'opemia' ) ),
		'comment_field' 		=> $comment_field,
		'fields' 				=> apply_filters( 'comment_form_default_fields', $fields ),
		'submit_field' 			=> '<div class="col-lg-12"><div class="form-submit">%1$s %2$s</div></div></div>',
		'submit_button'			=> '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
		'label_submit'			=> esc_html__( 'Post Comment', 'opemia' ),
	);

	comment_form( $args );
	?>

</div><!-- #comments -->
