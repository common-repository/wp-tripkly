<?php
/*
Plugin Name: WP Tripkly
Plugin URI: https://wordpress.org/plugins/wp-tripkly/
Description: Show Tripkly Trails activity on your WordPress site.
Version: 1.2
Author: Kodo' srl <info@kodogroup.it>
Author URI: http://www.kodogroup.it
License: GPLv3
*/

define('TRIPKLY_BASE_EMBED_URL', 'https://www.tripkly.com/community/trails/embed/');
define('VERSION', '1.2');

function iframe_unqprfx_embed_shortcode( $atts ) {
	$defaults = array(
		'id' => '854',
		'width' => '100%',
		'height' => '600',
		'scrolling' => 'no',
		'class' => 'iframe-class',
		'frameborder' => '0'
	);

    $atts = shortcode_atts( $defaults , $atts, 'tripkly' );

    $src = TRIPKLY_BASE_EMBED_URL.esc_attr($atts['id']).'/';

	$html = '<!-- WP Tripkly v.'.VERSION.' https://wordpress.org/plugins/wp-tripkly/ -->'."\n";

	$html .='<iframe';
	$html .= ' src="'.$src.'"';
	foreach( $atts as $attr => $value ) {
		if ( strtolower($attr) != 'id') {
			$html .= ' ' . esc_attr( $attr );
			$html .= '="' . esc_attr( $value ).'"';
		}
	}
	$html .=' marginheight="0" marginwidth="0"';

	$html .='></iframe>';


	$html .= '<!-- /WP Tripkly v.'.VERSION.' https://wordpress.org/plugins/wp-tripkly/ -->'."\n";

	return $html;
}

add_shortcode( 'tripkly', 'iframe_unqprfx_embed_shortcode' );


function iframe_unqprfx_plugin_meta( $links, $file ) { // add 'Plugin page'
	if ( strpos( $file, 'iframe/iframe.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="https://www.tripkly.com" title="Tripkly" target="_blank">Tripkly</a>' ) );
		$links = array_merge( $links, array( '<a href="https://www.kodogroup.it" target="_blank">Kodo</a>' ) );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'iframe_unqprfx_plugin_meta', 10, 2 );
