/**
 * Main JavaScript
 */

// DOM is fully loaded
jQuery( document ).ready( function( $ ) {

	/******************************************
	 * LAYOUT
	 ******************************************/

	/*************** TOP BAR ******************/

	// Search Open
	$( '#exodus-top-bar-search-icon' ).click( function( e ) {

		// Open
		if ( ! $( '#exodus-top-bar-search-form' ).is( ':visible' ) ) {

			// Stop regular click action
			e.preventDefault();

			// Hide menu to make room for search
			$( '#exodus-top-bar-menu' ).hide();

			// Show search form
			$( '#exodus-top-bar-search-form' ).show();

			// Focus on search input
			$( '#exodus-top-bar-search-form input' ).focus();

			// Change searh icon into close icon
			$( this ).removeClass().addClass( 'el-icon-remove' );

		}

		// Close
		else {

			// Hide search form
			$( '#exodus-top-bar-search-form' ).hide();

			// Show menu
			$( '#exodus-top-bar-menu' ).show();

			// Change close icon into search icon
			$( this ).removeClass().addClass( 'el-icon-search' );

		}

	} );

	/***************** LOGO *******************/

	// Retina Logo
	// Set dimensions from normal image on retina logo element for proper sizing
	// CSS handles switching between two images with media queries
	// This method works best for Opera Mobile
	if ( $( '#exodus-logo-hidpi' ).length ) { // Retina version provided
		$( '<img>' ).attr( 'src', $( '#exodus-logo-regular' ).attr( 'src' ) ).load( function() {
			$( '#exodus-logo-hidpi' ).attr( 'width', this.width ).attr( 'height', this.height );
		} );
	}

	/************* HEADER MENU ****************/

	exodus_activate_menu();

	/************* HEADER ICONS ***************/

	var icons_inverval;

	// Hide menu icons if they will cause a second line after resize
	icons_inverval = setInterval( function() { // first page load (wait a moment for fonts to load)
		exodus_show_hide_menu_icons(); // in case menu changed size because of font
	}, 200 ); // keep trying to hide icons (font must be rendered for it to work)

	// Stop trying to hide icons after a few seconds
	setTimeout( function() {
		clearInterval( icons_inverval );
	}, 3000 );

	// Check after resize
	$( window ).resize( function() {
		exodus_show_hide_menu_icons();
	} );

	/*********** RESPONSIVE TOGGLE ************/

	// These things are done client-side so that it works with caching plugins
	// See more immediately executed code in <head> (better speed with caching and mobile)

	// "View Full Site" / "View Mobile Site" footer link clicked
	$( '#exodus-footer-responsive-toggle a' ).click( function( e ) {

		e.preventDefault();

		// Switch to full site
		if ( ! $.cookie( 'exodus_responsive_off' ) ) {
			$.cookie( 'exodus_responsive_off', 1, {
				path : exodus_main.site_path, // work on any page
				secure : exodus_main.is_ssl
			} );
		}

		// Switch to mobile site
		else {
			$.removeCookie( 'exodus_responsive_off', {
				path : exodus_main.site_path, // work on any page
				secure : exodus_main.is_ssl
			} );
		}

		// Reload the current page without re-posting
		window.location = window.location.href;

	} );

	/******************************************
	 * SEARCH FORM
	 ******************************************/

	// Submit on link button click
	$( '.exodus-search-button' ).click( function( event ) {
		event.preventDefault();
		$( this ).parent( 'form' ).submit();
	} );

	// Trim search query and stop of empty
	$( '.exodus-search-form form' ).submit( function( event ) {

		var s;

		s = $( 'input[name=s]', this ).val().trim();

		if ( s.length ) { // submit trimmed value
			$( 'input[name=s]', this ).val( s );
		} else { // empty, stop
			event.preventDefault();
		}

	} );

	/******************************************
	 * HOMEPAGE
	 ******************************************/

	// Homepage Slider
	if ( $( '.flexslider' ).length ) {

		var enable_slideshow, single_slide;

		// Enable or disable automatic slideshow based on theme options
		enable_slideshow = exodus_main.slider_slideshow;

		// Show first slide immediately for faster loading on mobile
		setTimeout( function() {
			$( '.flexslider .slides > li:first-child' ).show();
		}, 500 ); // after slight delay while image resizes, to avoid flicker

		// If only one slide, add a second slide; otherwise slider will not initialize and video will not work properly (controls will be hidden after initialization)
		single_slide = false;
		if ( $( '.flexslider ul li' ).length == 1 ) {
			single_slide = true;
			enable_slideshow = false; // disable because only one slide (don't show hidden slide)
			$( '.flexslider ul' ).append( '<li></li>' );
		}

		// Initialize slider
		$( '#exodus-slider .flexslider' ).flexslider( {
			animation: 'fade',								// 'slide' always has one issue or another
			animationDuration: 250,
			slideshow: enable_slideshow,					// Boolean: Animate slider slideshow
			slideshowSpeed: exodus_main.slider_speed,		// Integer: Set the speed of the slideshow cycling, in milliseconds
			directionNav: false,							// Boolean: Create navigation for previous/next navigation? ( true/false )
			controlsContainer: '#exodus-slider-container',	// Add controls here
			start: function( slider ) { // when first slide loads

				var fade_speed, opacity;

				// Hide controls if only one slide (see "if only only slide" above )
				if ( single_slide ) {
					$( '.flex-control-nav' ).hide();
				}

				// Play video slide on click
				$( '.exodus-slide-video' ).click( function( event ) {

					var slide_element, slide_id, video_url, video_html, match, vimeo_id, youtube_id;

					event.preventDefault();

					// Get data
					slide_element = $( this );
					slide_id = slide_element.attr( 'id' );
					video_url = $( 'a', slide_element ).attr( 'href' );
					video_html = '';

					// Vimeo
					if ( video_url.indexOf( 'vimeo' ) > -1 ) {

						// Extract video ID from Vimeo URL and build HTML for player
						match = video_url.match( /\d+/ );
						if ( match && match[0].length ) {
							vimeo_id = match[0];
							video_html = '<iframe src="' + '//player.vimeo.com/video/' + vimeo_id + '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" width="1170" height="500" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						}

					}

					// YouTube
					else if ( video_url.indexOf( 'youtu' ) > -1 ) { // match youtube.com or youtu.be

						// Get video ID from YouTube URL and build HTML for player
						// Helpful regex information here: http://bit.ly/13H4NKw
						match = video_url.match( /.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/ );
						if ( match && match[1].length == 11 ){
							youtube_id = match[1];
							video_html = '<iframe src="' + '//www.youtube.com/embed/' + youtube_id + '?wmode=transparent&amp;autoplay=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;modestbranding=1" width="1170" height="500" frameborder="0" allowfullscreen></iframe>';
						}

					}

					// Show the video
					if ( video_html ) {

						// Pause slideshow
						slider.pause();

						// Hide slide image (contains overlay)
						$( '.exodus-slide-image-container', slide_element ).hide();

						// Destroy previous video frame if still there
						$( '.exodus-slide-video-wrapper' ).remove();

						// Add wrapper to video iframe so it can be centered
						video_html = '<div class="exodus-slide-video-wrapper exodus-centered-content">' + video_html + '</div>';

						// Inject the video iframe
						$( slide_element ).append( video_html );

						// Responsive sizing for video
						exodus_resize_slider_content();
						setTimeout( function() {
							exodus_resize_slider_content(); // ensure YouTube control rendering
						}, 2000 );

					}

				} );

				// Click on caption container goes to URL if this is not video slide
				// Otherwide clicks to right and left of title/description do nothing
				$( '.exodus-slide-not-video.exodus-slide-linked .exodus-slide-caption' ).click( function( event ) {

					var click_url;

					event.preventDefault();

					// Get Click URL
					click_url = $( 'a', $( this ).parents( 'li' ) ).attr( 'href' );

					// Go to URL
					if ( click_url ) {
						if ( $( this ).parents( '.exodus-slide-click-new' ).length > 0 ) {
							window.open( click_url, '_blank' );
						} else {
							window.location.href = click_url;
						}
					}

				} );

				// Resize slide contents title/description and video for responsive
				$( window ).bind( 'load resize', function() {
					exodus_resize_slider_content();
				} );

			},
			before: function() { // before slide changes

				// Destroy all video iframes
				$( '.exodus-slide-video-wrapper' ).remove();

				// Show image again (hidden when video played)
				$( '.exodus-slide-image-container' ).show();

				// Resize responsive
				exodus_resize_slider_content();

			},
			after: function() {

				// Resize responsive
				exodus_resize_slider_content();

			}

		} );

	}

	/******************************************
	 * GALLERIES
	 ******************************************/

	// Make clicks on caption also go to URL
	$( '.gallery-caption' ).click( function() {

		var $parent, url;

		$parent = $( this ).parent();
		url = $( 'a', $parent ).prop( 'href' );

		// Go to URL if no data- attributes, which indicate Jetpack Carousel or possbily other lightbox
		if ( url && $.isEmptyObject( $( '.gallery-icon img', $parent ).data() ) ) {
			window.location = url;
		}

	} );

	/******************************************
	 * COMMENTS
	 ******************************************/

	// Scroll to comments when comments link at top of single page/post clicked
	if ( $( 'a.exodus-scroll-to-comments' ).length ) {
		$( 'a.exodus-scroll-to-comments' ).smoothScroll( {
			offset: -60,
			easing: 'swing',
			speed: 1200
		} );
	}

	// Scroll to comments when link from another page is clicked
	if ( '#comments' == window.location.hash || '#respond' == window.location.hash ) {

		// Scroll down
		$.smoothScroll( {
			scrollTarget: '#comments',
			easing: 'swing',
			speed: 1200
		} );

	}

	// Comment Validation using jQuery Validation Plugin by Jörn Zaefferer
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	if ( jQuery().validate ) { // if plugin loaded

		var $validate_params, $validate_comment_field;

		// Parameters
		$validate_params = {
			rules: {
				author: {
					required: exodus_main.comment_name_required !== '' ? true : false // if WP configured to require
				},
				email: {
					required: exodus_main.comment_email_required !== '' ? true : false, // if WP configured to require
					email: true // check validity
				},
				url: 'url' // optional but check validity
			},
			messages: { // localized error strings
				author: exodus_main.comment_name_error_required,
				email: {
					required: exodus_main.comment_email_error_required,
					email: exodus_main.comment_email_error_invalid
				},
				url: exodus_main.comment_url_error_invalid
			}
		};

		// Comment textarea
		// Use ID instead of name to work with Antispam Bee plugin which duplicates/hides original textarea
		$validate_comment_field = $( '#comment' ).attr( 'name' );
		$validate_params['rules'][$validate_comment_field] = 'required';
		$validate_params['messages'][$validate_comment_field] = exodus_main.comment_message_error_required;

		// Validate the form
		$( '#commentform' ).validate( $validate_params );

	}

	/******************************************
	 * WIDGETS
	 ******************************************/

	// Categories dropdown redirect
	$( '.exodus-dropdown-taxonomy-redirect' ).change( function() {

		var taxonomy, taxonomy_id;

		taxonomy = $( this ).prev( 'input[name=taxonomy]' ).val();
		taxonomy_id = $( 'option:selected', this ).val();

		if ( taxonomy && taxonomy_id && -1 != taxonomy_id ) {
			location.href = exodus_main.home_url + '/?redirect_taxonomy=' + taxonomy + '&id=' + taxonomy_id;
		}

	} );

	// Modify widget link counts
	// Change (#) into <span class="exodus-widget-link-count">#</span> so it can be styled
	$( '.widget_categories li, .widget_ctfw-categories li, .widget_ctfw-archives li, .widget_ctfw-galleries li, .widget_archive li, .widget_pages li, .widget_links li, .widget_nav_menu li' ).each( function() {

		var modified_count;

		// Manipulate it
		modified_count = $( this ).html().replace( /(<\/a>.*)\(([0-9]+)\)/, '$1 <span class="exodus-widget-link-count">$2</span>' );

		// Replace it
		$( this ).html( modified_count );

	} )

	/******************************************
	 * CSS CLASSES
	 ******************************************/

	/************** BODY CLASSES **************/

	// <body> classes for client detection (mobile, browser, etc.) should be done here with JS
	// instead of in body.php so that they work when caching plugins are used.

	// Mobile Detection
	// Useful for :hover issue with slider video play icon (some browsers handle it better than others)
	// The regex below is based on wp_is_mobile() -- good enough for most
	// "Mobile" will handle iOS devices and many others
	if ( navigator.userAgent.match( /Mobile|Android|Silk\/|Kindle|BlackBerry|Opera Mini|Opera Mobi/ ) ) {
		$( 'body' ).addClass( 'exodus-is-mobile' );
	} else {
		$( 'body' ).addClass( 'exodus-not-mobile' );
	}

	// iOS Detection
	// Especially useful for re-styling form submit buttons, which iOS takes too much liberty with
	if ( navigator.userAgent.match( /iPad|iPod|iPhone/ ) ) {
		$( 'body' ).addClass( 'exodus-is-ios' );
	} else {
		$( 'body' ).addClass( 'exodus-not-ios' );
	}

	// No Rounded Corners in IE11
	// Because there is a border radius bug that makes extra lines in dropdowns, caption images, gallery captions
	// http://stackoverflow.com/questions/20051783/ie-11-border-radius-weirdness-did-not-occur-in-ie-9-and-ie-10
	// Remove this when Microsoft fixes the issue
	if ( $( 'body' ).hasClass( 'exodus-rounded' ) && navigator.userAgent.match( /Trident.*rv[ :]*11\./ ) ) { // IE11 and Rounded Corners on
		$( 'body' )
			.removeClass( 'exodus-rounded' )
			.addClass( 'exodus-not-rounded' );
	}

} );

/******************************************
 * FUNCTIONS
 ******************************************/

/************ MENU ACTIVATION *************/

var $exodus_header_menu_raw; // make accessible to exodus_activate_menu() later

// Activate Menu Function
// Also used in Customizer admin preview JS
function exodus_activate_menu() {

	var $header_menu_raw_list, $header_menu_raw_items;

	// Continue if menu not empty
	if ( ! jQuery( '#exodus-header-menu-content' ).children().length ) {
		return;
	}

	// Make copy of menu contents before Superfish modified
	// Original markup works better with MeanMenu (less Supersubs and styling issues)
	if ( ! jQuery( $exodus_header_menu_raw ).length ) { // not done already
		$exodus_header_menu_raw = jQuery( '<div></div>' ); // Create empty div
		$header_menu_raw_list = jQuery( '<ul></ul>' ); // Create empty list
		$header_menu_raw_items = jQuery( '#exodus-header-menu-content' ).html(); // Get menu items
		$header_menu_raw_list = $header_menu_raw_list.html( $header_menu_raw_items ); // Copy items to empty list
		$exodus_header_menu_raw = $exodus_header_menu_raw.html( $header_menu_raw_list ); // Copy list to div
	}

	// Regular Menu (Superfish)
	jQuery( '#exodus-header-menu-content' ).supersubs( { // Superfish dropdowns
		minWidth: 13,	// minimum width of sub-menus in em units
		maxWidth: 13,	// maximum width of sub-menus in em units
		extraWidth: 1	// extra width can ensure lines don't sometimes turn over due to slight rounding differences and font-family
	} ).superfish( {
		delay: 250,
		disableHI: false,
		animation: {
			opacity: 'show',
			//height:'show'
		},
		speed: 150, // animation
		onInit: function() {

			// Responsive Menu (MeanMenu) for small screens
			// Replaces regular menu with responsive controls
			// Init after Superfish done because Supersubs needs menu visible for calculations
		    jQuery( $exodus_header_menu_raw ).meanmenu( {
		    	meanMenuContainer: '#exodus-header-menu',
				meanScreenWidth: 640, // use responsive.css to hide #exodus-header-menu-content at same size
		    	meanRevealPosition: 'center',
		    	meanRemoveAttrs: true, // remove any Superfish classes, duplicate item ID's, etc.
		    	removeElements: '#exodus-header-menu-inner' // toggle visibility of regular
		    } );

		}

	} );

}

/************** HEADER ICONS **************/

// Hide menu bar's social icons if they will show on second line
function exodus_show_hide_menu_icons() {

	var header_menu_icons_visible, header_menu_inner_width, header_menu_links_icons_width;

	// Gather data
	header_menu_icons_visible = jQuery( '#exodus-header-menu .exodus-list-icons' ).is( ':visible' );
	header_menu_inner_width = jQuery( '#exodus-header-menu-inner' ).width();
	header_menu_links_icons_width = jQuery( '#exodus-header-menu-content' ).width() + jQuery( '#exodus-header-menu .exodus-list-icons' ).width() + 30; /* pad for wider trigger zone */

	// If menu link and menu icon containers have same total width as their container, hide icons so they don't appear on second line
	if ( header_menu_links_icons_width >= header_menu_inner_width ) {
		if ( header_menu_icons_visible ) {
			jQuery( '#exodus-header-menu .exodus-list-icons' ).hide();
		}
	}

	// Show icons if there is room again
	else if ( ! header_menu_icons_visible ) {
		jQuery( '#exodus-header-menu .exodus-list-icons' ).show();
	}

}

/************ HOMEPAGE SLIDER *************/

// Resize slide contents title/description and video for responsive
// See .exodus-centered-content { width: 90%; } in responsive.css
// Cannot do with CSS alone for slider because % of slider is 1700 overflow hidden, not actual window width
// Done on load, resize and on video play
function exodus_resize_slider_content() {

	var browser_width, centered_decimal, content_width;

	// Get browser width
	browser_width = jQuery( window ).width();

	// Get percentage being used for centered content at this screen size
	centered_decimal = parseFloat( jQuery( '.exodus-centered-content' ).css( 'width' ) ) / parseFloat( jQuery( '.exodus-centered-content' ).parent().css( 'width' ) );

	// Calculate width for centered slider title/description
	content_width = browser_width * centered_decimal;

	// Modify width of title/desc
	jQuery( '#exodus-slider .exodus-centered-content' ).width( content_width );

	// Then show it if not already shown -- hidden on first load so user doesn't see snap info place
	jQuery( '.exodus-slide-caption' ).fadeIn( 250 );

	// Modify width of video
	if ( browser_width <= 1280 ) {
		jQuery( '.exodus-slide-video-wrapper' ).width( browser_width ); // 100% for videos
	} else {
		jQuery( '.exodus-slide-video-wrapper' ).width( browser_width ).width( content_width ); // helps YouTube controls render
	}

}

/***************** FONTS ******************/

// Change <body> helper font/setting class
// Used by Theme Customizer (and front-end demo customizer)
function exodus_update_body_font_class( setting, font ) {

	var setting_slug, font_slug, body_class;

	// Prepare strings
	setting_slug = setting.replace( /_/g, '-' );
	font_slug = font.toLowerCase().replace( /\s/g, '-' ); // spaces to -
	body_class = 'exodus-' + setting_slug + '-' + font_slug;

	// Remove old class
	jQuery( 'body' ).removeClass( function( i, css_class ) { // helpful information: http://bit.ly/1f7KH3f
		return ( css_class.match ( new RegExp( '\\b\\S+-' + setting_slug + '-\\S+', 'g' ) ) || [] ).join( ' ' );
	} )

	// Add new class
	jQuery( 'body' ).addClass( body_class );

}