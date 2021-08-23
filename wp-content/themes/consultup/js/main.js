(function(){

    jQuery(document).ready(function() {
        /* =================================
        ===        STICKY HEADER        ====
        =================================== */
        jQuery(window).on('load', function() {  
          jQuery(".navbar-wp").sticky({ topSpacing: 0 });
        });

        /* ---------------------------------------------- /*
         * Scroll top
         /* ---------------------------------------------- */

        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.page-scroll-up').fadeIn();
            } else {
                jQuery('.page-scroll-up').fadeOut();
            }
        });
		
		jQuery('.page-scroll-up').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 700);
			return false;
		});
    });
})(jQuery);