<?php
/**
 * WordPress Feature Support
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
 * Add theme support for WordPress features
 *
 * @since 1.0
 */
function exodus_add_theme_support_wp() {

	// Featured images
	add_theme_support( 'post-thumbnails' );

	// RSS feeds in <head>
	add_theme_support( 'automatic-feed-links' );

	// Admin editor stylesheet
	add_editor_style( CTFW_THEME_CSS_DIR . '/admin-editor.css' );

}

add_action( 'after_setup_theme', 'exodus_add_theme_support_wp' );
