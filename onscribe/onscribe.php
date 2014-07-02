<?php
/*
Plugin Name: Onscribe
Version: 0.1.0
Plugin URI: http://www.github.com/onscribe/wordpress/
Description: Simple integration for Onscribe. Adds subscription buttons to any webpage.
Author: Onscribe
Author URI: http://onscri.be/
*/
/**
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

if (function_exists( 'add_action' ) ) {
	// plugin interface

	// modules
	include_once( dirname(__FILE__) ."/settings.php");

	// interface

	add_shortcode( 'onscribe', 'onscribe_shortcode' );

}

// Shortcode
// Example: [onscribe]
function onscribe_shortcode( $atts ) {
	$template = "embed.php";
	extract( shortcode_atts( array(
		"product" => "",
		"style" => "",
		"prompt" => ""
	), $atts ) );
	// output
	ob_start();
	require( plugin_dir_path( __FILE__ ) ."/". $template);
	return ob_get_clean();
}

?>