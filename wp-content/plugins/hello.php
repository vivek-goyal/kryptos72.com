<?php
/**
 * @package home.pl
 * @version 1.0
 */
/*
Plugin Name: Rekomendowane wtyczki
Plugin URI: https://home.pl/wordpress-polecane-wtyczki/
Description: Zapoznaj się z <a target=\"_blank\" href=\"https://home.pl/wordpress-polecane-wtyczki/\">listą wtyczek rekomendowanych przez home.pl</a>. Sprawdź wtyczki polecane przez ekspertów i skorzystaj z wyjątkowych rabatów dla klientów home.pl.
Author: home.pl
Version: 1.0
Author URI: home.pl
*/


// This just echoes the chosen line, we'll position it later
function hello_homepl() {
	echo "<p id='homepl'>Zapoznaj się z <a target=\"_blank\" href=\"https://pomoc.home.pl/baza-wiedzy/wordpress-lista-przydatnych-dodatkowpluginow/\">listą wtyczek rekomendowanych przez home.pl</a>. Sprawdź wtyczki polecane przez ekspertów i skorzystaj z wyjątkowych rabatów dla klientów home.pl.</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_homepl' );

// We need some CSS to position the paragraph
function homepl_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#homepl {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'homepl_css' );

?>
