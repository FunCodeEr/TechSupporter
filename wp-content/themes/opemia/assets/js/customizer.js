/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	wp.customize(
		'opemia_contact_header', function( value ) {
			value.bind(
				function( newval ) {
					$( '.top-header .tp-links .tp-address' ).text( newval );
				}
			);
		}
	);

	wp.customize(
		'header_phone_number', function( value ) {
			value.bind(
				function( newval ) {
					$( '.top-header .tp-links .tp-phone' ).text( newval );
				}
			);
		}
	);

	// Header Call To action
	wp.customize(
		'opemia_button_label', function( value ) {
			value.bind(
				function( newval ) {
					$( '.bottom-header .header-content .cta-label' ).text( newval );
				}
			);
		}
	);

	wp.customize(
		'opemia_user_link', function( value ) {
			value.bind(
				function( newval ) {
					$( '.pl-links .user-icon a' ).text( newval );
				}
			);
		}
	);

	wp.customize(
		'opemia_heart_link', function( value ) {
			value.bind(
				function( newval ) {
					$( '.pl-links .heart-icon a' ).text( newval );
				}
			);
		}
	);

	wp.customize(
		'opemia_footer_copyright_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.bottom-footer .copyright-text' ).text( newval );
				}
			); 
		}
	);
	
} )( jQuery );
