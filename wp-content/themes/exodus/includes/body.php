<?php
/**
 * <body> Functions
 *
 * @package    Exodus
 * @subpackage Functions
 * @copyright  Copyright (c) 2014, churchthemes.com
 * @link       http://churchthemes.com/themes/exodus
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since      1.0
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/*******************************************
 * BODY CLASSES
 *******************************************/

/**
 * Add helper classes to <body>
 *
 * IMPORTANT: Do not do client detection (mobile, browser, etc.) here.
 * Instead, do in theme's JS so works with caching plugins.
 *
 * @since 1.0
 * @param array $classes Classes currently being added to body tag
 * @return array Modified classes
 */
function exodus_add_body_classes( $classes ) {

	// Fonts
	$fonts_areas = array( 'logo_font', 'tagline_font', 'heading_font', 'menu_font', 'body_font' );
	foreach ( $fonts_areas as $font_area ) {

		$font_name = ctfw_customization( $font_area );
		$font_name = sanitize_title( $font_name );

		$font_area = str_replace( '_', '-', $font_area );

		$classes[] = 'exodus-' . $font_area . '-' . $font_name;

	}

	// Logo
	if ( 'image' == ctfw_customization( 'logo_type' ) && ctfw_customization( 'logo_image' ) ) {
		$classes[] = 'exodus-has-logo-image';
	} else {
		$classes[] = 'exodus-no-logo-image';
	}

	// Logo text lowercase
	if ( ctfw_customization( 'logo_text_lowercase' ) ) { // don't detect logo type of text, because if image and no upload, reverts to text
		$classes[] = 'exodus-has-logo-text-lowercase';
	} else {
		$classes[] = 'exodus-no-logo-text-lowercase';
	}

	// Tagline below logo
	if ( ctfw_customization( 'tagline_under_logo' ) ) {
		$classes[] = 'exodus-has-tagline-under-logo';
	} else {
		$classes[] = 'exodus-no-tagline-under-logo';
	}

	// Tagline on right
	if ( 'tagline' == ctfw_customization( 'header_right' ) ) {
		$classes[] = 'exodus-has-tagline-right';
	} else {
		$classes[] = 'exodus-no-tagline-right';
	}

	// Rounded Corners
	if ( ctfw_customization( 'rounded_corners' ) ) {
		$classes[] = 'exodus-rounded';
	} else {
		$classes[] = 'exodus-not-rounded';
	}

	return $classes;

}

add_filter( 'body_class', 'exodus_add_body_classes' );
