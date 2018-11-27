<?php
$heading  = get_sub_field( 'heading' );
$category = get_sub_field( 'category' );

$events = eo_get_events(array(
	"numberposts"       => 2,
    "event_start_after" => "today",
    "event-category"    => $category->slug,
));

$category_link = get_term_link( $category );

if ( array_filter( $events ) ):
?>
<article class="sidebar_events_wrap sidebar_component margined_lg clearfix">
	<div class="sidebar_events">
		<header class="sidebar_header">
			<h4 class="heading_dashed"><?php echo $heading; ?></h4>
		</header>
		<?php
			$i = 0;
			foreach ( $events as $event ) :
				$time  = strtotime( $event->StartDate );
				$month = date( 'M', $time );
				$day   = date( 'j', $time );
				$link  = get_the_permalink( $event->ID );

				$cats = wp_get_object_terms( $event->ID, 'event-category' );

				$button_title = get_field( 'link_title', $event->ID );
				$button_url   = get_field( 'link_url', $event->ID );
				$button_new_window = get_field( 'link_new_winow', $event->ID );
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
					<a href="<?php echo $link; ?>" class="event_title"><?php echo get_the_title( $event->ID ); ?></a>
				</div>
			</div>
			<?php if ( $button_title && $button_url ) : ?>
			<a href="<?php echo $button_url; ?>"<?php fielding_new_window( $button_new_window ); ?> class="btn btn_transparent"><?php echo $button_title; ?></a>
			<?php endif; ?>
			<a href="<?php echo $link; ?>" class="event_link">Event Details</a>
		</div>
		<?php
				$i++;
			endforeach;
		?>
		<a href="<?php echo $category_link; ?>" class="btn btn_gray">View All Events</a>
	</div>
</article>
<?php
endif;