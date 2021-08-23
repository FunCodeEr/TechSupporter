<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Opemia
 */

if ( ! function_exists( 'opemia_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function opemia_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf( '%s', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<li><i class="fa fa-calendar-alt"></i>' . wp_kses_post( $posted_on ) . '</li>';
	}
endif;

if ( ! function_exists( 'opemia_posted_by' ) ) :

	function opemia_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%1$s %2$s', 'post author', 'opemia' ),
			'<i class="far fa-user"></i>',
			'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<li> ' . wp_kses_post( $byline ) . '</li>';

	}
endif;

if ( ! function_exists( 'opemia_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function opemia_entry_footer() {
		
		echo '<ul class="meta">';
			opemia_posted_on();
			opemia_entry_comment_counts();
			$categories_list = get_the_category_list( esc_html__( ', ', 'opemia' ) );
			if ( $categories_list && opemia_blog_categorized() ) {
				printf( '<li><i class="fas fa-folder"></i> %1$s </li>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ) {
				printf( '<li>%1$s %2$s</li>', '<i class="fa fa-tags"></i>', wp_kses_post( $tags_list ) );
			}
		echo '</ul>';
	}
endif;

if ( ! function_exists( 'opemia_entry_single_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, comments, athors, date.
	 */
	function opemia_entry_single_meta() {
		
		echo '<ul class="meta">';

			opemia_posted_by();
			opemia_entry_comment_counts();
			opemia_posted_on();

			$categories_list = get_the_category_list( esc_html__( ', ', 'opemia' ) );
			if ( $categories_list && opemia_blog_categorized() ) {
				printf( '<li><i class="fa fa-tags"></i> %1$s </li>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

		echo '</ul>';
	}
endif;

if ( ! function_exists( 'opemia_entry_comment_counts' ) ) :
	function opemia_entry_comment_counts() {

		if ( post_password_required() || ! comments_open() ) {
			return false;
		}


		echo '<li><i class="fa fa-comment"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'opemia' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		
		echo '</li>';
	}
endif; 

if ( ! function_exists( 'opemia_blog_categorized' ) ) :
	function opemia_blog_categorized() {

		if ( false === ( $all_the_cool_cats = get_transient( 'opemia_blog_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'opemia_blog_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			return true;
		} else {
			return false;
		}
	}

endif;

/**
 * Flush out the transients used.
 */
function opemia_category_transient_flush() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	delete_transient( 'opemia_blog_categories' );
}
add_action( 'edit_category', 'opemia_category_transient_flush' );
add_action( 'save_post',     'opemia_category_transient_flush' );

if ( ! function_exists( 'opemia_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function opemia_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
			<div class="post-thumbnail">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
						the_post_thumbnail(
							'post-thumbnail',
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
								'class'	=> 'w-100'
							)
						);
					?>
				</a>
			</div>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
