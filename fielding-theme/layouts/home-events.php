<?php
$label      = get_field( 'events_label' );
$heading    = get_field( 'events_heading' );
$link_title = get_field( 'events_link_title' );
$link_url   = get_field( 'events_link_url' );
$link_new_window = get_field( 'events_link_new_window' );
$background = get_field( 'events_background' );
$category   = get_field( 'events_category' );

$events = eo_get_events(array(
	"numberposts"       => 3,
    "event_start_after" => "today",
    "event-category"    => $category->slug,
));

$background_options = fielding_background_home_events( $background );

$equalize_options = array(
	"target" => array(
		".js-equalize_one",
		".js-equalize_two",
	)
);

if ( array_filter( $events ) ):
?>
<section class="info_sessions_wrap">
	<div class="js-background" data-background-options="<?php fielding_json_attribute( $background_options ); ?>">
		<div class="info_sessions">
			<div class="fs-row">
				<div class="fs-cell-centered fs-lg-10">
					<h2 class="media_carousel_label"><?php echo $label; ?></h2>
					<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
				</div>
				<div class="js-equalize" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
					<?php
						$i = 0;
						foreach ( $events as $event ) :
							$class = ($i > 0) ? "fs-xs-hide fs-sm-hide" : " fs-xs-full fs-sm-full";

							$time  = strtotime( $event->StartDate );
							$month = date( 'M', $time );
							$day   = date( 'j', $time );

							$cats = wp_get_object_terms( $event->ID, 'event-category' );

							$button_title = get_field( 'link_title', $event->ID );
							$button_url   = get_field( 'link_url', $event->ID );
					?>
					<div class="fs-cell <?=$class?> fs-all-third">
						<div class="event_wrap clearfix js-equalize_child">
							<p class="event_date"><?php echo $month; ?><span><?php echo $day; ?></span></p>
							<div class="event_deets equalize_one equalize_group js-equalize_one">
								<h3 class="heading_3"><?php echo get_the_title( $event->ID ); ?></h3>
								<?php if ( array_filter( $cats ) ) : ?>
								<p class="event_type"><?php echo $cats[0]->name; ?></p>
								<?php endif; ?>
							</div>
							<div class="event_btns equalize_two js-equalize_two">
								<?php if ( $button_title && $button_url ) : ?>
								<a href="<?php echo $button_url; ?>" class="btn btn_transparent"><?php echo $button_title; ?></a>
								<?php endif; ?>
								<a href="<?php echo get_the_permalink( $event->ID ); ?>" class="event_link"><span>Event</span> Details</a>
							</div>
						</div>
					</div>
					<?php
							$i++;
						endforeach;
					?>
				</div>
				<div class="clear"></div>
				<div class="fs-cell-centered fs-xs-full fs-sm-3 fs-md-4 fs-lg-5 fs-xl-4">
					<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="btn btn_transparent_arrow"><?php echo $link_title; ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
endif;