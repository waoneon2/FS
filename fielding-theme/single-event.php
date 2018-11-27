<?php
global $fielding_calendar_active;
global $fielding_calendar_page;

$fielding_calendar_active = true;
$fielding_calendar_page   = get_the_title();

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$page_title = get_the_title();
		$page_intro = get_field( 'page_intro' );

		$location = get_field( 'location' );

		$start_date = strtotime( $post->StartDate );
		$start_time = strtotime( $post->StartTime );
		$end_time   = strtotime( $post->FinishTime );

		$month = date( 'F', $start_date );
		$day   = date( 'j', $start_date );
		$year  = date( 'Y', $start_date );

		$button_title = get_field( 'link_title', $event->ID );
		$button_url   = get_field( 'link_url', $event->ID );
		$button_new_window = get_field( 'link_new_window', $event->ID );

		get_template_part( 'layouts/page-header' );
?>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav', 'events' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="event_locations margined_bottom">
				<?php if ( $location ) : ?>
				<span class="bold_link"><span class="map"></span><?php echo $location; ?></span>
				<?php endif; ?>
				<span class="bold_link"><span class="time"></span>
				<?php echo $month; ?> <?php echo $day; ?>, <?php echo $year; ?>,
				<?php
					if ( eo_is_all_day() ) {
						echo 'All Day';
					} else {
						echo date( FIELDING_TIME_FORMAT, $start_time );

						if ($end_time) {
							echo " &ndash; " . date( FIELDING_TIME_FORMAT, $end_time );
						}
					}
				?></span>
			</div>
			<div class="clear typography margined_md_bottom">
				<?php the_content(); ?>
				<div class="event_buttons clear">
					<?php if ( $button_title && $button_url ) : ?>
					<a href="<?php echo $button_url; ?>"<?php fielding_new_window( $button_new_window ); ?> class="btn btn_drk"><?php echo $button_title; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'layouts/sidebar', 'events' ); ?>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();