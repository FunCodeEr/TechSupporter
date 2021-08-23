<?php

class Opemia_Walker_Comment extends Walker_Comment {
 
	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 * @access protected
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>
		<<?php echo esc_html($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'clearfix parent' : 'clearfix', $comment ); ?>>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-dt">
			
			<div class="comment-thumb">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>

			<div class="comment-info">
				
				<?php printf( '<h3>%1$s </h3><span>%2$s at %3$s</span>', get_comment_author_link( $comment ), get_comment_date( '', $comment ), get_comment_time() ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'opemia' ), '<span class="comment-edit-link">', '</span>' ); ?>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'opemia' ); ?></p>
				<?php endif;

				wpautop( comment_text() );
				
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) ) );
				?>

			</div><!-- .comment-text -->
		</div><!-- .comment-body -->
<?php
	}

	/**
     * Outputs a pingback comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment The comment object.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function ping( $comment, $depth, $args ) {
        $tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo esc_html($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
        	<h4><?php esc_html_e( 'Pingback:', 'opemia' ); ?></h4>
            <?php comment_author_link( $comment ); ?> <?php edit_comment_link( esc_html__( 'Edit', 'opemia' ), '<span class="edit-link">', '</span>' ); ?>
        <?php
    }
}