(function( jQuery ){
	if ( typeof ssp_init_params !== 'undefined' ) {
		jQuery.each( ssp_init_params, function( key, value ) {
			if ( jQuery( "#ssp-" + key ).length == 0 ) {
				jQuery( "body" ).prepend( "<div id='ssp-" + key + "' class='simplesignuppro'> </div>" );
			}
			jQuery( "#ssp-" + key ).simplesignuppro( value );
		})
	}
})( jQuery );