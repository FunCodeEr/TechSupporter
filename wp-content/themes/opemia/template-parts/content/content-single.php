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

		<?php opemia_entry_single_meta(); ?>
		
		<?php the_title( '<h2 class="page-title"><a href="'. get_the_permalink() .'">', '</a></h2>' ); ?>
		<div class="post-info-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'opemia' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'opemia' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>

		<div class="post-single-btm">
			<?php
			$tags_list = get_the_tag_list( '', ' ' );
			if ( $tags_list ) {
				printf( '<div class="post-tagss">%1$s %2$s</div>', '<i class="fa fa-tags"></i>', wp_kses_post( $tags_list ) );
			}
			?>
			<?php if ( function_exists( 'opemia_social_share_icons' ) && $icons = opemia_social_share_icons() ) : ?>
				<div class="post-share-options">
					<span class="share-link"><i class="fa fa-share"></i></span>
					<ul class="social-vicons">
						<?php foreach ( $icons as $icon ) : 
							if ( empty( $icon ) ) {
								continue;
							}
						?>
						<li><?php echo wp_kses_post( $icon ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div><!--post-share-options end-->
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
