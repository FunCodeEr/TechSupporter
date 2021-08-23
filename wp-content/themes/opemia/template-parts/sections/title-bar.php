<?php
$opemia_display_breadcrumb = get_theme_mod( 'opemia_display_breadcrumb', true );

if ( '1' != $opemia_display_breadcrumb ) {
	return false;
}

$breadcrumb_bg	= get_theme_mod('breadcrumb_background_bg', esc_url( get_template_directory_uri() .'/assets/images/pager-bg.jpg' ) ); 

?>

<section class="pager-sec">
	<div class="fixed-bg pager-bg" style="background-image:url('<?php echo esc_url($breadcrumb_bg); ?>');"></div>
	<div class="container">
		<div class="pager-details">
			<h1>
				<?php
				$page_title = get_the_title();

				if ( ! is_archive() ) {
		            if ( is_home() ) {
		                if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		                    $page_title = get_the_title( $page_for_posts );
		                } elseif ( is_front_page() ) {
		                    $page_title = esc_html__( 'Latest News', 'opemia' );
		                }
		            } elseif ( is_page() ) {
		                $page_title = get_the_title();
		            } elseif ( is_404() ) {
		                $page_title = esc_html__( 'Page Not Found', 'opemia' );
		            } elseif ( is_search() ) {
		                $page_title = esc_html__( 'Search results', 'opemia' );
		            } else {
		                $page_title = get_the_title();

		                if ( is_singular( 'post' ) ) {
		                    $page_title = esc_html__( 'Latest Blog', 'opemia' );
		                } elseif ( ( class_exists( 'WooCommerce' ) && is_product() ) ) {
		                    $page_title = esc_html__( 'Product Details', 'opemia' );
		                }
		            }
		        } elseif ( is_author() ) {
		            $page_title = esc_html__( 'Author:', 'opemia' ) . ' ' . get_the_author();
		        } else {
		            $page_title = get_the_archive_title();
		            if ( ( class_exists( 'WooCommerce' ) && is_shop() ) ) {
		                $page_title = esc_html__( 'Products', 'opemia' );
		            }
		        }

		        echo wp_kses_post( $page_title );
				?>
			</h1>
			<?php
			if ( function_exists( 'opemia_breadcrumbs' ) ) :
				opemia_breadcrumbs();
			endif;?>
		</div><!--pager-details end-->
	</div>
</section><!--pager-sec end-->
