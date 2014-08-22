<?php
/**
 * Short Content Footer
 *
 * Show appropriate button(s) beneath short display of post in loop.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Post type
$post_type = get_post_type();

?>

<footer class="exodus-entry-footer exodus-clearfix">

	<?php
	// Sermon Buttons
	if ( 'ctc_sermon' == $post_type ) :

		// Get sermon meta data
		// $has_full_text		True if full text of sermon was provided as post content
		// $video_player		Embed code generated from uploaded file, URL for file on other site, page on oEmbed-supported site such as YouTube, or manual embed code (HTML or shortcode)
		// $video_download_url 	URL for download link (available only for local files, "Save As" will be forced)
		// $audio_player		Same as video
		// $audio_download_url 	Same as video
		// $pdf_download_url 	URL for download link (local or externally hosted, but "Save As" forced only if local)
		extract( ctfw_sermon_data() );

	?>
	<ul class="exodus-entry-footer-item exodus-list-buttons">

		<?php

		// Make sure there is no whitespace between items since they are inline-block

		?><li>
			<a href="<?php the_permalink(); ?>">
				<?php if ( $has_full_text ) : ?>
					<span class="exodus-button-icon <?php exodus_icon_class( 'read' ); ?>"></span>
					<?php _e( 'پڑھیے', 'exodus' ); ?>
				<?php else : ?>
					<?php _ex( 'تفصیلات', 'sermon button', 'exodus' ); ?>
				<?php endif; ?>
			</a>
		</li><?php

		if ( $video_player || $video_download_url ) :
			?><li>
				<a href="<?php echo esc_url( $video_player ? add_query_arg( 'player', 'video', get_permalink() ) : get_permalink() ); ?>">
					<span class="exodus-button-icon <?php exodus_icon_class( 'video-play' ); ?>"></span>
					<?php _e( 'دیکھیے', 'exodus' ); ?>
				</a>
			</li><?php
		endif;

		if ( $audio_player || $audio_download_url ) :
			?><li>
				<a href="<?php echo esc_url( $audio_player ? add_query_arg( 'player', 'audio', get_permalink() ) : get_permalink() ); ?>">
					<span class="exodus-button-icon <?php exodus_icon_class( 'audio-play' ); ?>"></span>
					<?php _e( 'سنیے', 'exodus' ); ?>
				</a>
			</li><?php
		endif;

		if ( $pdf_download_url ) :
			?><li>
				<a href="<?php echo esc_url( $pdf_download_url ); ?>" title="<?php echo esc_attr( __( 'Download PDF', 'exodus' ) ); ?>">
					<span class="exodus-button-icon <?php exodus_icon_class( 'pdf-download' ); ?>"></span>
					<?php _e( 'ڈاؤنلوڈ کریں', 'exodus' ); ?>
				</a>
			</li><?php
		endif;

		?>

	</ul>

	<?php
	// Location Buttons
	elseif ( 'ctc_location' == $post_type ) :

		// Get data
		// $address, $show_directions_link, $directions_url, $phone, $times, $map_lat, $map_lng, $map_type, $map_zoom
		extract( ctfw_location_data() );

	?>
	<ul class="exodus-entry-footer-item exodus-list-buttons">

		<li><a href="<?php the_permalink(); ?>"><?php _e( 'تفصیلات', 'exodus' ); ?></a></li><?php

		// Make sure there is no whitespace between items since they are inline-block

		if ( $directions_url ) :
			?><li><a href="<?php echo esc_url( $directions_url ); ?>" target="_blank"><span class="exodus-button-icon <?php exodus_icon_class( 'location-directions' ); ?>"></span><?php _e( 'ہدایات', 'exodus' ); ?></a></li><?php
		endif;

		?>

	</ul>

	<?php
	// Event Buttons
	elseif ( 'ctc_event' == $post_type ) :

		// Get data
		// $date (localized range), $start_date, $end_date, $time, $venue, $address, $show_directions_link, $directions_url, $map_lat, $map_lng, $map_type, $map_zoom
		extract( ctfw_event_data() );

	?>
	<ul class="exodus-entry-footer-item exodus-list-buttons">

		<li><a href="<?php the_permalink(); ?>"><?php _e( 'تفصیلات', 'exodus' ); ?></a></li><?php

		// Make sure there is no whitespace between items since they are inline-block

		if ( $directions_url ) :
			?><li><a href="<?php echo esc_url( $directions_url ); ?>" target="_blank"><span class="exodus-button-icon <?php exodus_icon_class( 'event-directions' ); ?>"></span><?php _e( 'ہدایات', 'exodus' ); ?></a></li><?php
		endif;

		?>

	</ul>

	<?php
	// Person Buttons
	elseif ( 'ctc_person' == $post_type ) :
	?>

		<?php if ( ctfw_has_content() ) : // show only if has bio content ?>
			<ul class="exodus-entry-footer-item exodus-list-buttons">
				<li><a href="<?php the_permalink(); ?>"><?php _e( 'سوانح پڑھیں', 'exodus' ); ?></a></li>
			</ul>
		<?php endif; ?>

	<?php
	// Gallery Page Button
	elseif ( 'page' == $post_type && CTFW_THEME_PAGE_TPL_DIR . '/gallery.php' == $post->page_template ) :
	?>

		<ul class="exodus-entry-footer-item exodus-list-buttons">

			<li>
				<a href="<?php the_permalink(); ?>">
					<span class="exodus-button-icon <?php exodus_icon_class( 'gallery' ); ?>"></span>
					<?php _e( 'View Gallery', 'exodus' ); ?>
				</a>
			</li>

		</ul>

	<?php
	// Generic Post Type Button
	else :

		$post_type_obj = get_post_type_object( $post->post_type );

	?>

		<div class="exodus-entry-footer-item exodus-clearfix">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="exodus-button">

				<?php
				// <!--more--> quicktag is used; show "Read More"
				if ( ctfw_has_more_tag() ) :
				?>

					<?php _e( 'Read More', 'exodus' ); ?>

				<?php elseif ( ! empty( $post_type_obj->labels->singular_name ) ) :?>

					<?php
					/* translators: %s is post type name */
					printf( __( 'View %s', 'exodus' ), $post_type_obj->labels->singular_name );
					?>

				<?php endif; ?>

			</a>
		</div>

	<?php endif; ?>

</footer>

