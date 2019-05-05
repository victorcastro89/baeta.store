// Main Shoptimizer js.
;
( function( $ ) {
	'use strict';

$( '.post-type-archive-product #secondary' ).prepend( '<div class="close-drawer"></div>' );

	// Toggle cart drawer.
	$( '.mobile-filter' ).click( function( e ) {
		e.stopPropagation();
		e.preventDefault();
		$( 'body' ).toggleClass( 'filter-open' );
	} );

	// Close the drawer when clicking/tapping outside it
	$( document ).on( 'touchstart click', function( e ) {
    var container = $( '.filter-open #secondary' );

    if ( ! container.is( e.target ) && 0 === container.has( e.target ).length ) {
        $( 'body' ).removeClass( 'filter-open' );
    }
	} );

		// Close drawer - click the x icon
	$( '.close-drawer' ).on( 'click', function() {
		$( 'body' ).removeClass( 'filter-open' );
	} );


$( document ).ready( function() {
var $loading = $( '#ajax-loading' ).hide();
$( document )
  .ajaxStart( function() {
    $loading.show();
  } )
  .ajaxStop( function() {
    $loading.hide();
  } );

  } );

	// Reposition size guide link on the single product template.
	$( '.button-wrapper' ).addClass( 'shoptimizer-size-guide' ).each( function() {
    $( this ).insertAfter( $( this ).parent().find( '.product-widget' ) );
} );


	// Add a class if term description text or an image exists.
  if ( 0 < $( '.term-description' ).length ) {
      $( '.woocommerce-products-header' ).addClass( 'description-exists' );
  }

  if ( 0 < $( '.woocommerce-products-header img' ).length ) {
      $( '.woocommerce-products-header' ).addClass( 'image-exists' );
  }

	// Overlay when a full width menu item is hovered over.
	$( document ).ready( function() {
		$( 'li.full-width' ).hover(
			function() {
				$( '.site-content' ).toggleClass( 'overlay' );
			}
		);
	} );

	// Mobile menu toggle.
	$( document ).ready( function() {
		$( '.menu-toggle' ).on( 'click', function() {
			$( this ).toggleClass( 'active' );
			$( 'body' ).toggleClass( 'mobile-toggled' );
			$( window ).scrollTop( 0 );
		return false;
		} );
	} );

	// Reveal/Hide Mobile sub menus.
	$( 'body .main-navigation ul.menu > li.menu-item-has-children > .caret' ).on( 'click', function( e ) {
		$( this ).closest( 'li' ).toggleClass( 'dropdown-open' );
		e.preventDefault();
	} );

	// Open the drawer if a product is added to the cart
  $( '.product_type_simple.add_to_cart_button' ).on( 'click', function( e ) {
		e.preventDefault();
    $( 'body' ).toggleClass( 'drawer-open' );
	} );


		// Toggle cart drawer.
	$( '.site-header-cart .cart-click' ).click( function( e ) {
		e.stopPropagation();
		e.preventDefault();
		$( 'body' ).toggleClass( 'drawer-open' );
	} );


	// Close the drawer when clicking outside it
	$( document ).mouseup( function( e ) {
    var container = $( '.shoptimizer-mini-cart-wrap' );

    if ( ! container.is( e.target ) && 0 === container.has( e.target ).length ) {
        $( 'body' ).removeClass( 'drawer-open' );
    }
	} );

	// Close drawer - click the x icon
	$( '.close-drawer' ).on( 'click', function() {
		$( 'body' ).removeClass( 'drawer-open' );
	} );

	// Scroll to top.
	$( '.logo-mark a' ).click( function() {
		$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
		return false;
	} );

	// Smooth scroll for sticky single product - only for variable and grouped items
	$( 'a.variable-grouped-sticky[href*="#"]' ).on( 'click', function( e ) {
		e.preventDefault();

		$( 'html, body' ).animate( {
			scrollTop: $( $( this ).attr( 'href' ) ).offset().top - 80}, 500, 'linear' );
	} );

}( jQuery ) );


// Add product quantity up down selectors
var shoptimizer = shoptimizer || {},
$ = jQuery;

shoptimizer.fancyNumberInputs = {

	init: function() {

		shoptimizer.fancyNumberInputs.addQuantityMarkup();
		shoptimizer.fancyNumberInputs.handleQuantityElements();

		$( 'body' ).on( 'wc_fragments_refreshed', function() {
			shoptimizer.fancyNumberInputs.addQuantityMarkup();
			shoptimizer.fancyNumberInputs.handleQuantityElements();
		} );

	},

	addQuantityMarkup: function() {
		$( '<div class="quantity-nav"><div class="quantity-button quantity-up"></div><div class="quantity-button quantity-down"></div></div>' ).insertAfter( '.quantity input' );
	},

	handleQuantityElements: function() {

		$( '.quantity' ).each( function() {
			var $spinner = $( this ),
				$input = $spinner.find( 'input[type="number"]' ),
				inputVal = parseFloat( $input.val() ),
				$btnUp = $spinner.find( '.quantity-up' ),
				$btnDown = $spinner.find( '.quantity-down' ),
				min = $input.attr( 'min' ) ? $input.attr( 'min' ) : 1,
				max = $input.attr( 'max' ) ? $input.attr( 'max' ) : 99999;

			if ( inputVal >= max ) {
				$btnUp.addClass( 'disabled' );
			}
			if ( inputVal <= min ) {
				$btnDown.addClass( 'disabled' );
			}

			$input.on( 'change blur', function() {

				var newVal = parseFloat( $( this ).val() );

				if ( ! $( 'body' ).hasClass( 'woocommerce-cart' ) && ( ! newVal || 0 >= newVal ) ) {
					$( this ).val( 1 );
					newVal = 1;
				}

				if ( newVal >= max ) {
					$btnUp.addClass( 'disabled' );
					$( this ).val( max );
				} else if ( newVal <= min ) {
					$btnDown.addClass( 'disabled' );
				} else {
					$btnUp.add( $btnDown ).removeClass( 'disabled' );
				}

			} );

			$btnUp.on( 'click', function() {
				var oldValue = parseFloat( $input.val() );
				if ( oldValue >= max ) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue + 1;
					$btnDown.removeClass( 'disabled' );
				}
				$spinner.find( 'input' ).val( newVal );
				$spinner.find( 'input' ).trigger( 'change' );
			} );

			$btnDown.on( 'click', function() {
				var oldValue = parseFloat( $input.val() );
				if ( oldValue <= min ) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue - 1;
					$btnUp.removeClass( 'disabled' );
				}
				$spinner.find( 'input' ).val( newVal );
				$spinner.find( 'input' ).trigger( 'change' );
			} );

		} );

	}

};

$( document ).ready( function( ) {
	shoptimizer.fancyNumberInputs.init();
} );


/*
 * jQuery.BiggerLink v2.0.1
 * http://www.ollicle.com/eg/jquery/biggerlink/
 *
 * Copyright (c) 2009 Oliver Boermans
 * http://creativecommons.org/licenses/MIT/
 *
 * 2009-11-22 (22 Nov 2009)
*/
( function( a ) {
a.fn.biggerlink = function( b ) {
var c = {biggerclass: 'bl-bigger', hoverclass: 'bl-hover', hoverclass2: 'bl-hover2', clickableclass: 'bl-hot', otherstriggermaster: true, follow: 'auto'};if ( b ) {
a.extend( c, b );
}a( this ).filter( function() {
return 0 < a( 'a', this ).length;
} ).addClass( c.clickableclass ).css( 'cursor', 'pointer' ).each( function( g ) {
var d = a( this ).data( 'biggerlink', {hovered: false, focused: false, hovered2: false, focused2: false} );var e = {all: a( 'a', this ), big: a( this ), master: a( 'a:first', this ).data( 'biggerlink', {status: 'master'} ).addClass( c.biggerclass ), other: a( 'a', this ).not( a( 'a:first', this ) ).data( 'biggerlink', {status: 'other'} )};a( 'a', this ).andSelf().each( function() {
var i = a.extend( a( this ).data( 'biggerlink' ), e );a( this ).data( 'biggerlink', i );
} );var h = d.attr( 'title' );var f = d.data( 'biggerlink' ).master.attr( 'title' );if ( f && ! h ) {
d.attr( 'title', f );
}d.mouseover( function( i ) {
window.status = a( this ).data( 'biggerlink' ).master.get( 0 ).href;a( this ).addClass( c.hoverclass );a( this ).data( 'biggerlink' ).hovered = true;
} ).mouseout( function( i ) {
window.status = '';if ( ! a( this ).data( 'biggerlink' ).focused ) {
a( this ).removeClass( c.hoverclass );
}a( this ).data( 'biggerlink' ).hovered = false;
} ).bind( 'click', function( i ) {
if ( ! a( i.target ).closest( 'a' ).length ) {
a( this ).data( 'biggerlink' ).master.trigger( {type: 'click', source: 'biggerlink'} );i.stopPropagation();
}
} );e.all.bind( 'focus', function() {
a( this ).data( 'biggerlink' ).big.addClass( c.hoverclass );a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).focused = true;
} ).bind( 'blur', function() {
if ( ! a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).hovered ) {
a( this ).data( 'biggerlink' ).big.removeClass( c.hoverclass );
}a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).focused = false;
} );e.master.bind( 'click', function( i ) {
if ( 'biggerlink' == i.source ) {
if ( true === c.follow || 'auto' == c.follow && false !== i.result ) {
window.location = a( this ).attr( 'href' );
} else {
i.stopPropagation();
}
}
} );if ( c.otherstriggermaster ) {
e.other.addClass( c.biggerclass ).bind( 'click', function( i ) {
a( this ).data( 'biggerlink' ).master.trigger( {type: 'click', source: 'biggerlink'} );i.preventDefault();i.stopPropagation();
} );
} else {
e.other.bind( 'focus', function() {
a( this ).data( 'biggerlink' ).big.addClass( c.hoverclass2 );a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).focused2 = true;
} ).bind( 'blur', function() {
if ( ! a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).hovered2 ) {
a( this ).data( 'biggerlink' ).big.removeClass( c.hoverclass2 );
}a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).focused2 = false;
} ).bind( 'mouseover', function( i ) {
a( this ).data( 'biggerlink' ).big.addClass( c.hoverclass2 );a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).hovered2 = true;i.stopPropagation();
} ).bind( 'mouseout', function( i ) {
if ( ! a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).focused2 ) {
a( this ).data( 'biggerlink' ).big.removeClass( c.hoverclass2 );
}a( this ).data( 'biggerlink' ).big.data( 'biggerlink' ).hovered2 = false;i.stopPropagation();
} );if ( ! e.other.attr( 'title' ) ) {
e.other.attr( 'title', '' );
}
}
} );return this;
};
} ( jQuery ) );

$( document ).ready( function( ) {
	$( '.feature' ).biggerlink();
} );
