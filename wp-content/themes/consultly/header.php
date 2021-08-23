<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Consultly
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"></a>
<div class="wrapper">
 <header class="ti-standard"> 
  <!--==================== TOP BAR ====================-->
  
    
  <?php do_action('icycp_consultup_top_header'); ?>
  <div class="clearfix"></div>
  <div class="ti-main-nav">
    <nav class="navbar navbar-expand-lg navbar-wp">
      <!-- Mobile -->
      <div class="container mobi-menu"> 
        <div class="navbar-header col"> 
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
      <!-- /Mobile -->
      <!-- desktop -->            
        <div class="container desk-menu">  
          <div class="navbar-header"> 
            <?php if(has_custom_logo()) {
            // Display the Custom Logo
            the_custom_logo();
            } else { ?>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> 
            <span> <?php bloginfo('name'); ?> </span> <br>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
              <span class="site-description"><?php echo $description; ?></span> 
            <?php endif;?></a><?php }?>
          </div>
          <!-- /navbar-toggle --> 
          <!-- Navigation -->
          <div class="collapse navbar-collapse"  id="navbar-wp">
            <?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
								'menu_class' => 'nav navbar-nav ml-auto',
								'fallback_cb' => 'consultup_fallback_page_menu',
								'walker' => new consultup_nav_walker()
							) ); ?>
          </div>
          <?php do_action('icycp_btn_widget_header'); ?>
        </div>
        <!-- /desktop --> 
      </nav>  
  </div>
</header>
<!-- #masthead --> 