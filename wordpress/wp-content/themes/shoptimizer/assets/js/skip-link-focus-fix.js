/** @format */
( function() {
	var is_webkit = -1 < navigator.userAgent.toLowerCase().indexOf( 'webkit' ),
		is_opera = -1 < navigator.userAgent.toLowerCase().indexOf( 'opera' ),
		is_ie = -1 < navigator.userAgent.toLowerCase().indexOf( 'msie' );

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener(
			'hashchange',
			function() {
				var element = document.getElementById( location.hash.substring( 1 ) );

				if ( element ) {
					if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
						element.tabIndex = -1;
					}

					element.focus();
				}
			},
			false
		);
	}
} () );
