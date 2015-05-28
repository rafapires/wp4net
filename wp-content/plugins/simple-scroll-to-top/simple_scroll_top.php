<?php
/*
Plugin Name: Simple Scroll To Top
Plugin URI: http://vijayakumar.org/web-development/simple-scroll-to-top-wordpresss-plugin/
Description: Smooth & simple scroll to top plug & play plugin helps to add "Back to top" in your blog. Activate the plugin & see the result.
Author: Vijayakumar S
Version: 1.0
Author URI: http://vijayakumar.org/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ 
function BacktoTop_style() { echo "<!-- Simple Scroll To Top 1.0 by Vijayakumar S -->
";?>
<?php } function load_bcktoTopjquery() { wp_enqueue_script(
		'newscript',
		plugins_url( '/js/backttoTop.js' , __FILE__ ),
		array( 'jquery' )
	); }
//Hook 
add_action( 'wp_enqueue_scripts', 'load_bcktoTopjquery' );
add_action('wp_head', 'BacktoTop_style');
?>