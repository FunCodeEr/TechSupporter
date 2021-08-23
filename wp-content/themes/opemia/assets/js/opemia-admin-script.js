( function( $ ){
    $( document ).on( 'click', '.notice-get-started-notice .notice-dismiss', function () {
        var type = $( this ).closest( '.notice-get-started-notice' ).data( 'notice' );
        $.ajax( ajaxurl, {
            type: 'POST',
            data: {
                action: 'opemia_dismissed_notice_handler',
                type: type,
            }
        } );
    } );

}( jQuery ) );