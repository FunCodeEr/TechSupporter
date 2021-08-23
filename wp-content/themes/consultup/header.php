<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package consultup
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"></a>
<div class="wrapper">
<header class="ti-headwidget trans" > 
  <!--==================== TOP BAR ====================-->
  <div class="container">
    <?php do_action('icycp_consultup_top_header'); ?>
  </div>
  <div class="clearfix"></div>
  <div class="container">
    <div class="ti-nav-widget-area d-none d-lg-block">
    <div class="row">
          <div class="col-md-3 col-sm-4 text-center-xs">
            <div class="navbar-header">
              <?php the_custom_logo(); ?>

              <?php  if ( display_header_text() ) : ?>
            <div class="site-branding-text">
				<h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h1>
				<p class="site-description"><?php echo esc_html(bloginfo('description')); ?></p>
			</div>
        <?php endif; ?>
          </div>
          </div>
          <?php do_action('icycp_top_widget_header'); ?>
        </div>
      </div></div>

     <div class="container"> 
    <div class="ti-menu-full">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-wp">
         <!-- mobi-menu -->
         <div class="container mobi-menu"> 
              <div class="navbar-header"> 
                <!-- Logo image --> 
                <?php the_custom_logo(); ?>
                <?php  if ( display_header_text() ) : ?>
                <div class="site-branding-text navbar-brand">
                  <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h1>
                  <p class="site-description"><?php echo esc_html(bloginfo('description')); ?></p>
                </div>
                  <?php endif; ?>
                <!-- /Logo image -->
                <!-- navbar-toggle -->  
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-wp">
                  <span class="fa fa-bars"></i></span>
                </button>
                <!-- /navbar-toggle --> 
            </div>
          </div>
          <!-- /mobi-menu --> 
          
          <div class="collapse navbar-collapse" id="navbar-wp">
          <?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
								'menu_class' => 'nav navbar-nav',
								'fallback_cb' => 'consultup_fallback_page_menu',
								'walker' => new Consultup_Nav_Walker()
							) ); 
						?>
          </div>
      </nav> <!-- /Navigation -->
    </div>
  </div>
</header>