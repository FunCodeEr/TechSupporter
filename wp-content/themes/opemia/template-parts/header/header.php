<?php
$opemia_show_search		= get_theme_mod('opemia_show_search');
$opemia_show_button		= get_theme_mod('opemia_show_button', true );
$opemia_button_label	= get_theme_mod('opemia_button_label');
$opemia_button_link		= get_theme_mod('opemia_button_link');

$enable_header_search = get_theme_mod( 'enable_header_search', true );
?>

<header>
	<?php do_action( 'opemia_top_header');?>
	
	<div class="bottom-header">
		<div class="container">
			<div class="header-content">
				<div class="logo">
					<?php
					if ( has_custom_logo() ) :	
						the_custom_logo();
					else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<h1 class="site-title">
								<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
							</h1>
						</a>
					<?php
					endif;
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
					<?php endif; ?>
				</div><!--logo end-->
				<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'opemia' ); ?>" role="navigation">
					<?php 
					wp_nav_menu( 
						array(  
							'theme_location' => 'primary',
							'menu_class' => 'menu-wrap'
						) 
					);
					?>
				</nav><!--navigation end-->

				<?php if ( true === $opemia_show_button && $opemia_button_label ) : ?>
					<a class="btn-default cta-label" href="<?php echo esc_url($opemia_button_link);?>"><?php echo esc_html($opemia_button_label); ?></a>
				<?php endif;
				if ( true === $enable_header_search ) : ?>
					<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
				<?php
				endif; ?>

				<a href="#" class="menu-btn">
					<span class="bar1"></span>
					<span class="bar2"></span>
					<span class="bar3"></span>
				</a><!--menu-bar end-->
			</div><!--header-content end-->
		</div>
	</div><!--bottom-header end-->
</header>

<?php
if ( true === $enable_header_search ) : ?>
	<div class="search-div">
		<a href="#" class="close-search"><i class="fa fa-window-close"></i></a>
		<?php echo get_search_form(); ?>
	</div><!--search-div end-->
<?php endif; ?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<div class="responsive-mobile-menu">
		<?php 
		wp_nav_menu( 
			array(  
				'theme_location' => 'primary',
				'menu_class' => 'menu-wrap',
			) 
		);
		?>
	</div><!--responsive-mobile-menu end-->

<?php endif; ?>

<?php
get_template_part( 'template-parts/sections/title-bar');
?>