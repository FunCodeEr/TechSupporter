<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Opemia
 */
	
printf( '</div> ');

$footer_bg = get_theme_mod('footer_bg', esc_url( get_template_directory_uri() .'/assets/images/footer-bg.png' ) );
$footer_btm_bg = get_theme_mod('footer_bottom_bg', esc_url( get_template_directory_uri() .'/assets/images/footer-bg2.jpg' ) );
$footer_menu = get_theme_mod( 'footer_menu', '1' );
$footer_sponsers = get_theme_mod( 'footer_sponsers' );
$footer_copyright = get_theme_mod( 'opemia_footer_copyright_text', esc_html__( 'Copyright © 2021. All Right Reserved', 'opemia' ) );

if ( $footer_sponsers && class_exists( 'Opemia_Addons' ) ) {
	get_template_part( 'template-parts/sections/sponsers' );
}
?>
	<footer>
		<?php if ( is_active_sidebar( 'opemia_footer_widget_area' ) && class_exists( 'Opemia_Addons' ) ) : ?>
			<div class="top-footer" style="background-image:url('<?php echo esc_url($footer_bg); ?>');">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'opemia_footer_widget_area' ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="bottom-footer" style="background-image:url('<?php echo esc_url($footer_btm_bg); ?>');">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<p class="copyright-text"><?php echo esc_html( $footer_copyright ); ?></p>
					</div>
					<div class="col-lg-6">
						<?php if ( $footer_menu == '1' && has_nav_menu( 'footer' ) ) : ?>
							<?php wp_nav_menu( array(
									'theme_location' => 'footer',
									'container'  => 'ul',
									'depth'		=> '1',
									'menu_class' => 'bt-links',
								) ); 
							?>
						<?php endif; ?>
					</div>
					<a href="#" class="scroll-btn"><i class="fa fa-level-up-alt"></i></a>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
