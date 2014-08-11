/**
 * Theme Customizer Controls
 */

jQuery( document ).ready( function( $ ) {

	/***************************************
	 * TOP BAR
	 ***************************************/

	// "Top Right" has changed
	$( "input[data-customize-setting-link^='" + exodus_customize.option_id + "[top_right]']" ).change( function() {

		var top_right, $header_items, $custom_content;

		if ( $( this ).is( ':checked' ) ) { // avoid triggering change on each radio for first load

			top_right = $( this ).val(); // selected radio value

			// Show/hide header right event/sermon/posts limit field if selected
			$header_items = $( '#customize-control-' + exodus_customize.option_id + '-top_right_items_limit' );
			if ( 'sermons' == top_right || 'events' == top_right || 'posts' == top_right ) {
				$header_items.show();
			} else {
				$header_items.hide();
			}

			// Show/hide "Custom Content" textarea if selected
			$custom_content = $( '#customize-control-' + exodus_customize.option_id + '-top_right_content' );
			if ( top_right == 'content' ) {
				$custom_content.show();
			} else {
				$custom_content.hide();
			}

		}

	} ).trigger( 'change' ); // for first load

	/***************************************
	 * LOGO & TAGLINE
	 ***************************************/

	// "Logo Type" has changed
	$( "input[data-customize-setting-link^='" + exodus_customize.option_id + "[logo_type]']" ).change( function() {

		var logo_type, $logo_image, $logo_hidpi, $logo_offset_x, $logo_text, $logo_text_lowercase, $logo_text_size;

		if ( $( this ).is( ':checked' ) ) { // avoid triggering change on each radio for first load

			logo_type = $( this ).val(); // selected radio value

			// Show/hide "Logo Image" and "Retina Logo" and "Move Logo" fields
			$logo_image = $( '#customize-control-' + exodus_customize.option_id + '-logo_image' );
			$logo_hidpi = $( '#customize-control-' + exodus_customize.option_id + '-logo_hidpi' );
			$logo_offset_x = $( '#customize-control-' + exodus_customize.option_id + '-logo_offset_x' );
			if ( logo_type == 'image' ) {
				$logo_image.show();
				if ( $( "#customize-control-" + exodus_customize.option_id + "-logo_image .preview-thumbnail img" ).css( 'display' ) != 'none' ) { // show Retina and Move controls only if there is an image logo
					$logo_hidpi.show();
					$logo_offset_x.show();
				}
			} else {
				$logo_image.hide();
				$logo_hidpi.hide();
				$logo_offset_x.hide();
				exodus_customize_preview_render_fix(); // fix Chrome rendering issue after $logo_image.hide();
			}

			// Show/hide "Logo Text", "Lowercase Text" and "Logo Text Size"
			$logo_text = $( '#customize-control-' + exodus_customize.option_id + '-logo_text' );
			$logo_text_lowercase = $( '#customize-control-' + exodus_customize.option_id + '-logo_text_lowercase' );
			$logo_text_size = $( '#customize-control-' + exodus_customize.option_id + '-logo_text_size' );
			if ( logo_type == 'text' ) {
				$logo_text.show();
				$logo_text_lowercase.show();
				$logo_text_size.show();
			} else {
				$logo_text.hide();
				$logo_text_lowercase.hide();
				$logo_text_size.hide();
			}

		}

	} ).trigger( 'change' ); // for first load

	// "Show tagline under logo" has changed
	$( "input[data-customize-setting-link^='" + exodus_customize.option_id + "[tagline_under_logo]']" ).change( function() {

		var $move_tagline;

		$move_tagline = $( '#customize-control-' + exodus_customize.option_id + '-tagline_offset_x' );

		// Show/hide if checked or not
		if ( $( this ).is( ':checked' ) ) {
			$move_tagline.show();
		} else {
			$move_tagline.hide();
		}

	} ).trigger( 'change' ); // for first load

	// "Right of Logo" has changed
	$( "input[data-customize-setting-link^='" + exodus_customize.option_id + "[header_right]']" ).change( function() {

		var header_right, $header_items, $custom_content;

		if ( $( this ).is( ':checked' ) ) { // avoid triggering change on each radio for first load

			header_right = $( this ).val(); // selected radio value

			// Show/hide "Custom Content" textarea if selected
			$custom_content = $( '#customize-control-' + exodus_customize.option_id + '-header_right_content' );
			if ( header_right == 'content' ) {
				$custom_content.show();
			} else {
				$custom_content.hide();
			}

		}

	} ).trigger( 'change' ); // for first load

	/***************************************
	 * NON-FORM CHANGES
	 ***************************************/

	// Continuously check controls for changes
	// 'change' cannot be detected for non-form elements such as images
	$.doTimeout( 500, function() {

		var $fullscreen_control, logo_type, $logo_hidpi_control, $move_logo_control;

		/**************************************
		 * LOGO & TAGLINE
		 **************************************/

		// Logo type
		logo_type = $( "input[data-customize-setting-link^='" + exodus_customize.option_id + "[logo_type]']:radio:checked" ).val();

		// Logo controls
		$logo_hidpi_control = $( '#customize-control-' + exodus_customize.option_id + '-logo_hidpi' );
		$move_logo_control = $( '#customize-control-' + exodus_customize.option_id + '-logo_offset_x' );

		// Show Retina Logo and Move Logo controls only while Logo uploaded ( and not using Text logo )
		if ( logo_type == 'image' && $( "#customize-control-" + exodus_customize.option_id + "-logo_image .preview-thumbnail img" ).css( 'display' ) != 'none' ) {
			$logo_hidpi_control.show();
			$move_logo_control.show();
		} else {
			$logo_hidpi_control.hide();
			$move_logo_control.hide();
		}

		/**************************************/

		// Keep checking for logo changes
		return true;

	} );

	// Render Fix
	$( '.accordion-section-title' ).click( function() {
		exodus_customize_preview_render_fix();
	} );

} );

/**
 * Rendering Fix
 *
 * This does a quick shift of controls container to reset the rendering.
 */

function exodus_customize_preview_render_fix() {

	var controls_width;

	controls_width = jQuery( '#customize-controls' ).width();

	jQuery( '#customize-controls' ).width( controls_width - 1 ); // slightly shrink cotainer

	jQuery.doTimeout( 10, function() { // restore width after slight delay
		jQuery( '#customize-controls' ).width( controls_width );
	}, true ); // once

}
