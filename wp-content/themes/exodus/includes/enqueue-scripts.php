<?php
/**
 * Enqueue JavaScript
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

/**
 * Enqueue JavaScript
 *
 * @since 1.0
 */
function exodus_enqueue_scripts() {

	// jQuery (included with WordPress)
	wp_enqueue_script( 'jquery' );

	// Superfish Menu
	wp_enqueue_script( 'hoverIntent' ); // packaged with WordPress
	wp_enqueue_script( 'superfish', ctfw_theme_url( CTFW_THEME_JS_DIR . '/superfish.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update
	wp_enqueue_script( 'supersubs', ctfw_theme_url( CTFW_THEME_JS_DIR . '/supersubs.js' ), array( 'jquery', 'superfish' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// MeanMenu (responsive)
	wp_enqueue_script( 'jquery-meanmenu', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery.meanmenu.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// Flexslider
	if ( is_page_template( CTFW_THEME_PAGE_TPL_DIR . '/homepage.php' ) ) {
		wp_enqueue_script( 'jquery-flexslider', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery.flexslider-min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update
	}

	// debouncedresize
	if ( is_page_template( CTFW_THEME_PAGE_TPL_DIR . '/homepage.php' ) || is_singular( 'ctc_sermon' ) ) {
		wp_enqueue_script( 'jquery-debouncedresize', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery.debouncedresize.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update
	}

	// Single Post
	if ( is_singular() ) { // single post or page

		// comment-reply.js to cause comment form to show below a comment when replying to a comment
		wp_enqueue_script( 'comment-reply' );

		// Comment Validation with jQuery Plugin
		if ( is_singular() ) { // single post
			wp_enqueue_script( 'jquery-validate', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery.validate.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update
		}

		// Smooth Scroll - comment and video/audio scroll down
		wp_enqueue_script( 'jquery-smooth-scroll', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery.smooth-scroll.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	}

	// jQuery Cookie
	// Used for "View Full Site" responsive link in footer
	// Note: Filename is changed default name triggers OUTDATED default mod_security rules: https://github.com/carhartl/jquery-cookie/issues/10
	// This explains the issue: http://docs.woothemes.com/document/jquery-cookie-fails-to-load/
	wp_enqueue_script( 'jquery-cookie', ctfw_theme_url( CTFW_THEME_JS_DIR . '/jquery_cookie.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// Main JS
	wp_enqueue_script( 'exodus-main', ctfw_theme_url( CTFW_THEME_JS_DIR . '/main.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// Theme data for JavaScript
	wp_localize_script( 'exodus-main', 'exodus_main', array( // pass WP data into JS from this point on
		'site_path'							=> ctfw_site_path(),
		'home_url'							=> home_url(),
		'is_ssl'							=> is_ssl(),
		'mobile_menu_label'					=> _x( 'Menu', 'menu dropdown', 'exodus' ),
		'slider_slideshow'					=> ctfw_customization( 'slider_slideshow' ),
		'slider_speed'						=> absint( ctfw_customization( 'slider_speed' ) * 1000 ), // convert seconds to milliseconds
		'comment_name_required'				=> get_option('require_name_email'), // name and email required on comments? (WP Admin: Settings > Discussion)
		'comment_email_required'			=> get_option('require_name_email'),
		'comment_name_error_required'		=> __( 'ضروری', 'exodus' ), // translatable string for comment form validation
		'comment_email_error_required'		=> __( 'ضروری', 'exodus' ),
		'comment_email_error_invalid'		=> __( 'ای میل غلط ہے', 'exodus' ),
		'comment_url_error_invalid'			=> __( 'یو آر ایل غلط ہے', 'exodus' ),
		'comment_message_error_required'	=> __( 'تبصرے کی ضرورت ہے', 'exodus' )
	));

}

add_action( 'wp_enqueue_scripts', 'exodus_enqueue_scripts' ); // front-end only
