<?php
if ( array_filter( $events ) ):
	$i = 0;
	foreach ( $events as $event ) :
		$start_date = strtotime( $event->StartDate );
		$start_time = strtotime( $event->StartTime );
		$end_time   = strtotime( $event->FinishTime );

		$month = date( 'M', $start_date );
		$day   = date( 'j', $start_date );
		$link  = get_the_permalink( $event->ID );

		$cats = wp_get_object_terms( $event->ID, 'event-category' );

		$button_title = get_field( 'link_title', $event->ID );
		$button_url   = get_field( 'link_url', $event->ID );
		$button_new_window = get_field( 'link_new_window', $event->ID );

		$location = get_field( 'location', $event->ID );
?>
<div class="event_listing_wrap">
	<div class="event_listing">
		<div class="event_bubble">
			<p class="event_bubble_date"><?php echo $month; ?><span><?php echo $day; ?></span></p>
		</div>
		<div class="event_details">
			<?php if ( array_filter( $cats ) ) : ?>
			<p class="event_type"><?php echo $cats[0]->name; ?></p>
			<?php endif; ?>
			<h3 class="event_title">
				<a href="<?php echo $link; ?>"><?php echo get_the_title( $event->ID ); ?></a>
			</h3>
			<div class="event_locations">
				<?php if ( $location ) : ?>
				<span class="bold_link"><span class="map"></span><?php echo $location; ?></span>
				<?php endif; ?>
				<span class="bold_link"><span class="time"></span><?php

					if ( eo_is_all_day( $event->ID ) ) {
						echo 'All Day';
					} else {
						echo date( FIELDING_TIME_FORMAT, $start_time );

						if ($end_time) {
							echo " &ndash; " . date( FIELDING_TIME_FORMAT, $end_time );
						}
					}
				?></span>
			</div>
			<div class="event_buttons clear">
				<?php if ( $button_title && $button_url ) : ?>
				<a href="<?php echo $button_url; ?>"<?php fielding_new_window( $button_new_window ); ?> class="btn btn_drk"><?php echo $button_title; ?></a>
				<?php endif; ?>
				<a href="<?php echo $link; ?>" class="btn">Event Details</a>
			</div>
		</div>
	</div>
</div>
<?php
		$i++;
	endforeach;
else:
?>
<div class="margined_lg_bottom">
	<p class="no_results">Sorry, no events found.</p>
</div>
<?php
	endif;