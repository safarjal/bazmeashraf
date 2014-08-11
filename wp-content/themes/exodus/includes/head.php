<?php
/**
 * <head> Functions
 *
 * Also see enqueue-styles.php and enqueue-scripts.php.
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
 * CUSTOM STYLES
 *******************************************/

/**
 * Insert custom styles (colors, background, fonts) from Customizer
 *
 * @since 1.0
 */
function exodus_head_styles() {

	// Colors
	$main_color = ctfw_customization( 'main_color' );
	$link_color = ctfw_customization( 'link_color' );

	// Fonts
	$logo_font_stack = ctfw_font_stack( ctfw_customization( 'logo_font' ), ctfw_google_fonts( 'logo_font' ) );
	$tagline_font_stack = ctfw_font_stack( ctfw_customization( 'tagline_font' ), ctfw_google_fonts( 'tagline_font' ) );
	$heading_font_stack = ctfw_font_stack( ctfw_customization( 'heading_font' ), ctfw_google_fonts( 'heading_font' ) );
	$menu_font_stack = ctfw_font_stack( ctfw_customization( 'menu_font' ), ctfw_google_fonts( 'menu_font' ) );
	$body_font_stack = ctfw_font_stack( ctfw_customization( 'body_font' ), ctfw_google_fonts( 'body_font' ) );

	// Logo/Tagline Offsets
	$logo_offset_x = (int) ctfw_customization( 'logo_offset_x' );
	$tagline_offset_x = (int)  ctfw_customization( 'tagline_offset_x' );

?>
<style type="text/css">
<?php echo exodus_style_selectors( 'logo_font' ); ?> {
	font-family: <?php echo $logo_font_stack; ?>;
}

<?php echo exodus_style_selectors( 'tagline_font' ); ?> {
	font-family: <?php echo $tagline_font_stack; ?>;
}

<?php echo exodus_style_selectors( 'heading_font' ); ?> {
	font-family: <?php echo $heading_font_stack; ?>;
}

<?php echo exodus_style_selectors( 'menu_font' ); ?> {
	font-family: <?php echo $menu_font_stack; ?>;
}

<?php echo exodus_style_selectors( 'body_font' ); ?> {
	font-family: <?php echo $body_font_stack; ?>;
}

<?php echo exodus_style_selectors( 'main_color' ); ?> {
	background-color: <?php echo $main_color; ?>;
}

<?php echo exodus_style_selectors( 'link_color' ); ?> {
	color: <?php echo $link_color; ?>;
}

<?php if ( $logo_offset_x ) : ?>
#exodus-logo-image {
	left: <?php echo $logo_offset_x; ?>px;
}
<?php endif; ?>

<?php if ( $tagline_offset_x ) : ?>
#exodus-logo-tagline {
	left: <?php echo $tagline_offset_x; ?>px;
}
<?php endif; ?>
</style>
<?php

}

add_action( 'wp_head', 'exodus_head_styles' ); // add style to <head>

/**
 * Produce list of selectors for fonts, colors, etc.
 *
 * @since 1.0
 * @param string $group Group of selectors to return
 * @return string CSS selector list
 */
function exodus_style_selectors( $group ) {

	$selectors = '';

	// Build elements array
	$groups = array(

		// Logo Font
		'logo_font' => array(
			'#exodus-logo-text'
		),

		// Tagline Font
		'tagline_font' => array(
			'.exodus-tagline', // under or right of logo
			'#exodus-top-bar-tagline'
		),

		// Menu Font
		'menu_font' => array(
			'#exodus-header-menu-content > li > a',
			'#exodus-footer-menu-links'
		),

		// Heading Font
		'heading_font' => array(
			'.exodus-logo-bar-right-item-date',
			'#exodus-intro-heading',
			'.exodus-main-title',
			'.exodus-entry-content h1',
			'.exodus-entry-content h2',
			'.exodus-entry-content h3',
			'.exodus-entry-content h4',
			'.exodus-entry-content h5',
			'.exodus-entry-content h6',
			'.exodus-author-box h1',
			'.exodus-person header h1',
			'.exodus-location header h1',
			'.exodus-entry-short h1',
			'#reply-title',
			'#exodus-comments-title',
			'.exodus-slide-title',
			'.exodus-caption-image-title',
			'#exodus-banner h1',
			'h1.exodus-widget-title',
		),

		// Body Font
		'body_font' => array(

			'body',
			'input',
			'textarea',
			'select',
			'.sf-menu li li a', /* dropdowns */
			'.exodus-slide-description',
			'#cancel-comment-reply-link',
			'.exodus-accordion-section-title',

			// Buttons
			'a.exodus-button',
			'a.comment-reply-link',
			'a.comment-edit-link',
			'a.post-edit-link',
			'.exodus-nav-left-right a',
			'input[type=submit]'

		),

		// Main Color
		'main_color' => array(
			'#exodus-header-menu',
			'.exodus-slide-title',
			'.exodus-slide-title:hover',
			'.flex-control-nav li a.active',
			'.flex-control-nav li a.active:hover',
			'#exodus-banner h1',
			'#exodus-banner h1 a',
			'.exodus-caption-image-title', // CT Highlight
			'.exodus-caption-image-title h1', // widget sidebar or home bottom
			'.exodus-logo-bar-right-item-date',
			'a.exodus-button',
			'.exodus-list-buttons a',
			'a.comment-reply-link',
			'.exodus-nav-left-right a',
			'.page-numbers a',
			'.exodus-sidebar-widget:not(.widget_ctfw-highlight) .exodus-widget-title',
			'.exodus-sidebar-widget:not(.widget_ctfw-highlight) .exodus-widget-title a',
			'.widget_tag_cloud a',
			'input[type=submit]',
			'.more-link'
		),

		// Link Color
		'link_color' => array(
			'a',
			'a:hover',
			'.exodus-list-icons a:hover',
			'a:hover .exodus-text-icon',
			'#exodus-top-bar-menu-links li a:hover',
			'.exodus-top-bar-right-item a:hover .exodus-top-bar-right-item-title',
			'.ctfw-breadcrumbs a:hover',
			'.exodus-comment-meta time:hover',
			'#exodus-footer-top-social-icons a:hover',
			'#exodus-footer-menu-links a:hover',
			'#exodus-notice a:hover'
		)

	);

	// Allow filtering
	$groups = apply_filters( 'exodus_style_selectors', $groups );

	// Build list
	if ( ! empty( $groups[$group] ) ) {
		$selectors = implode( ', ', $groups[$group] );
	}

	return $selectors;

}

/******************************************
 * JAVASCRIPT DETECTION
 ******************************************/

/**
 * Remove no-js and add js class to <html>
 *
 * Do this directly in <head> to it happens immediately (no wait for JS file to load or document ready)
 * This helps eliminate "flicker" effects in CSS due to a delay in classes being applied
 *
 * To Do: This could be made into a framework feature.
 *
 * @since 1.0
 */
function exodus_head_js_classes() {

?>
<script type="text/javascript">

jQuery( 'html' )
 	.removeClass( 'no-js' )
 	.addClass( 'js' );

</script>
<?php

}

add_action( 'wp_head', 'exodus_head_js_classes' );

/******************************************
 * FORCE "FULL SITE"
 ******************************************/

/**
 * "Full Site" JavaScript
 *
 * Done directly in header for immediately result with caching and mobile.
 * When done with ready or in external JS, there is a delay.
 *
 * This keeps "Full Site" from showing for a second before responsive view loads.
 *
 * Note: All "Full Site" changes are client-side to work with caching plugins.
 *
 * @since 1.0
 */
function exodus_head_responsive_js() {

?>
<script type="text/javascript">
if ( jQuery.cookie( 'exodus_responsive_off' ) ) {

	// Add helper class without delay
	jQuery( 'html' ).addClass( 'exodus-responsive-off' );

	// Disable responsive.css
	jQuery( '#exodus-responsive-css' ).remove();

} else {

	// Add helper class without delay
	jQuery( 'html' ).addClass( 'exodus-responsive-on' );

	// Add viewport meta to head -- IMMEDIATELY, not on ready()
	jQuery( 'head' ).append(' <meta name="viewport" content="width=device-width, initial-scale=1">' );

}
</script>
<?php

}

add_action( 'wp_head', 'exodus_head_responsive_js' );
