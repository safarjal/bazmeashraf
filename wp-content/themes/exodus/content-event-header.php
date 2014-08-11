<?php
/**
 * Post Header Meta (Full and Short)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get data
// $date (localized range), $start_date, $end_date, $time, $venue, $address, $show_directions_link, $directions_url, $map_lat, $map_lng, $map_type, $map_zoom
extract( ctfw_event_data() );

?>

<header class="exodus-entry-header exodus-clearfix">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="exodus-entry-image">
			<?php exodus_post_image(); ?>
		</div>
	<?php endif; ?>

	<div class="exodus-entry-title-meta">

		<?php if ( ctfw_has_title() ) : ?>
			<h1 class="exodus-entry-title<?php if ( is_singular( get_post_type() ) ) : ?> exodus-main-title<?php endif; ?>">
				<?php exodus_post_title(); // will be linked on short ?>
			</h1>
		<?php endif; ?>

		<?php if ( $date || $time || $venue || $address ) : ?>

			<ul class="exodus-entry-meta">

				<?php if ( $date ) : ?>
					<li class="exodus-entry-date exodus-event-full-date">
						<?php echo esc_html( $date ); ?>
					</li>
				<?php endif; ?>

				<?php if ( $time ) : ?>
					<li class="exodus-event-full-time exodus-content-icon">
						<span class="<?php exodus_icon_class( 'event-time' ); ?>"></span>
						<?php echo nl2br( wptexturize( $time ) ); ?>
					</li>
				<?php endif; ?>

				<?php if ( $venue ) : ?>
					<li class="exodus-event-full-venue exodus-content-icon">
						<span class="<?php exodus_icon_class( 'event-venue' ); ?>"></span>
						<?php echo esc_html( $venue ); ?>
					</li>
				<?php endif; ?>

				<?php if ( $address ) : ?>
					<li class="exodus-event-full-address exodus-content-icon">
						<span class="<?php exodus_icon_class( 'event-address' ); ?>"></span>
						<?php echo nl2br( wptexturize( $address ) ); ?>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

	</div>

</header>
