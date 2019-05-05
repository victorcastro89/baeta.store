<?php
$foo = 'something';
echo shoptimizer_safe_html( $foo );
function bar( $something ) {
	if ( $something = 7 ) {
		echo 'looks like it is a 7!';
	} else {
		echo 'definitely not a 7';
	}
}
