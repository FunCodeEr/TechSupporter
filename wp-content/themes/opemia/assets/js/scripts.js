var OpemiaThemeJs;

(function( $, opemiaConfig ) {
    'use strict';

    OpemiaThemeJs = {

        $document: $( document ),
        $window:   $( window ),
        $body:     $( 'body' ),

        init: function() {
            // Document ready event check
            this.$document.on( 'ready', this.documentReadyRender.bind( this ) );
            this.$document.on( 'ready', this.primaryMenu.bind( this ) );
        },

        documentReadyRender: function( event ) {
            var self      = this;

            $(".menu-btn").on("click", function() {
                $(this).toggleClass("active");
                $(".responsive-mobile-menu").toggleClass("active");
            });

            $(".responsive-mobile-menu ul ul").parent().addClass("menu-item-has-children");
            $(".responsive-mobile-menu ul li.menu-item-has-children > a").on("click", function() {
                $(this).parent().toggleClass("active").siblings().removeClass("active");
                $(this).next("ul").slideToggle();
                $(this).parent().siblings().find("ul").slideUp();
                return false;
            });

            $("html, .menu-btn.active").on("click", function() {
                $(".responsive-mobile-menu").removeClass("active");
                $(".menu-btn").removeClass("active");
            });

            $(".menu-btn, .responsive-mobile-menu").on("click", function(e) {
                e.stopPropagation();
            });

            // SEARCH POPUP
            $(".search-icon").on("click", function( e ) {
                e.preventDefault();
                $(".search-div").addClass("active");
            });

            $(".close-search").on("click", function( e ) {
                e.preventDefault();
                $(".search-div").removeClass("active");
            });

            // SCROLL UP
            $(".scroll-btn").click( function( e ) {
                $('html, body').animate({
                    scrollTop: $(".wrapper").offset().top
                }, 2000);
            });


            
        },

        primaryMenu: function() {

            var links, i, len,
            menu = document.querySelector( '.primary-menu-wrapper' );

            if ( ! menu ) {
                return false;
            }

            links = menu.getElementsByTagName( 'a' );

            // Each time a menu link is focused or blurred, toggle focus.
            for ( i = 0, len = links.length; i < len; i++ ) {
                links[i].addEventListener( 'focus', toggleFocus, true );
                links[i].addEventListener( 'blur', toggleFocus, true );
            }

            //Sets or removes the .focus class on an element.
            function toggleFocus() {
                var self = this;

                // Move up through the ancestors of the current link until we hit .primary-menu.
                while ( -1 === self.className.indexOf( 'menu-wrap' ) ) {
                    // On li elements toggle the class .focus.
                    if ( 'li' === self.tagName.toLowerCase() ) {
                        if ( -1 !== self.className.indexOf( 'focus' ) ) {
                            self.className = self.className.replace( ' focus', '' );
                        } else {
                            self.className += ' focus';
                        }
                    }
                    self = self.parentElement;
                }
            }

            jQuery(".responsive-mobile-menu ul li a").last().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if (keyCode == 9) {
                    if (e.shiftKey) {
                        
                    } else {
                        e.preventDefault(); 
                        jQuery(".menu-btn").eq(0).attr('tabindex', -1).trigger('focus');
                    }
                } 
              });
            
            jQuery(".responsive-mobile-menu ul li a").first().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if(e.shiftKey && e.keyCode == 9) { 
                    //shift was down when tab was pressed
                    e.preventDefault(); 
                    jQuery(".menu-btn").eq(0).attr('tabindex', 0).trigger('focus');
                }
            });

            jQuery(".menu-btn").on('keydown', function (e) {
                if ($(this).hasClass('active')){
                    var keyCode = e.keyCode || e.which;
                    if(keyCode == 9) { 
                        if(e.shiftKey) { 
                            e.preventDefault(); 
                            //shift was down when tab was pressed
                            jQuery(".responsive-mobile-menu ul li a").last().attr('tabindex', 0).trigger('focus');
                        } else {
                            e.preventDefault(); 
                            jQuery(".responsive-mobile-menu ul li a").first().attr('tabindex', 0).trigger('focus');
                        }
                    }
                }
            });
    
            /* search */
            jQuery(".search-div form button").first().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if(keyCode == 9) { 
                    e.preventDefault(); 
                    if(e.shiftKey) { 
                        //shift was down when tab was pressed
                        jQuery(".search-div form input").last().attr('tabindex', 0).trigger('focus');
                    } else {
                        jQuery(".search-div .close-search").first().attr('tabindex', 0).trigger('focus');
                    }
                }
            });
    
            /* search */
            jQuery(".search-div .close-search").first().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if(keyCode == 9) { 
                    e.preventDefault(); 
                    if(e.shiftKey) { 
                        //shift was down when tab was pressed
                        jQuery(".search-div form button").last().attr('tabindex', 0).trigger('focus');
                    } else {
                        jQuery(".search-div form input").first().attr('tabindex', 0).trigger('focus');
                    }
                }
            });
            /* search */
            jQuery(".search-div form input").first().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if(keyCode == 9) { 
                    if(e.shiftKey) { 
                        e.preventDefault(); 
                        //shift was down when tab was pressed
                        jQuery(".search-div .close-search").last().attr('tabindex', 0).trigger('focus');
                    } else {
                    }
                }
            });
            /* search */
            jQuery(".search-div .close-search").first().on('click', function(e) { 
                e.preventDefault(); 
                //shift was down when tab was pressed
                jQuery(".search-icon").last().attr('tabindex', 0).trigger('focus');
            });
           
            /* search */
             jQuery(".search-icon").first().on('keydown', function(e) { 
                var keyCode = e.keyCode || e.which; 
                if(keyCode == 13) { 
                    e.preventDefault();
                    $(".search-div").addClass("active");
                    setTimeout(() => {
                        jQuery(".search-div form input").last().attr('tabindex', 0).trigger('focus');
                    }, 500)
                }
                //shift was down when tab was pressed
            });

        }
    }

    OpemiaThemeJs.init();

}( jQuery, window.opemiaConfig ));