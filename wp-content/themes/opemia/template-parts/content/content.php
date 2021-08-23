<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opemia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	
	<?php opemia_post_thumbnail(); ?>

	<div class="post-info">
		<?php opemia_entry_footer(); ?>
		
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'opemia' ) );
		}?>
		<?php the_title( '<h2><a href="'. get_the_permalink() .'">', '</a></h2>' ); ?>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'opemia' ) . '">',
				'after'    => '</nav>',
				/* translators: %: page number. */
				'pagelink' => esc_html__( 'Page %', 'opemia' ),
			)
		);

		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
