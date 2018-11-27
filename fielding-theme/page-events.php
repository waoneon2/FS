<?php
/**
 * Template Name: Events Calendar Landing
 */

$paged = get_query_var( 'paged' );

if ( ! isset( $page_title ) ) {
	$page_title = "Event Calendar";
}

get_header();

$events = eo_get_events(array(
	"numberposts"       => 5,
    "event_start_after" => "today",
));

// Featured
$category = get_term_by( 'slug', 'featured', 'event-category' );
$featured_events = eo_get_events( array(
	"numberposts"       => 3,
	"event_start_after" => "today",
	"event-category"    => $category->slug,
) );
?>
<div class="fs-row breadcrumb_wrap">
	<div class="fs-cell breadcrumb_overlay">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<section class="info_sessions_wrap margined_lg_bottom">
	<div class="featured_events">
		<div class="info_sessions">
			<div class="fs-row">
				<div class="fs-cell-centered fs-lg-10">
					<h4 class="heading_dashed">Featured Events</h4>
				</div>
				<?php
					$equalize_options = array(
						"target" => array(
							".js-equalize_one",
							".js-equalize_two",
						),
						"minWidth" => "740px",
					);
				?>
				<div class="js-equalize" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
					<?php
						$i = 0;
						foreach ( $featured_events as $event ) :
							$class = ($i > 0) ? "fs-xs-hide fs-sm-hide" : " fs-xs-full fs-sm-full";

							$time  = strtotime( $event->StartDate );
							$month = date( 'M', $time );
							$day   = date( 'j', $time );

							$cats = wp_get_object_terms( $event->ID, 'event-category' );

							$button_title = get_field( 'link_title', $event->ID );
							$button_url   = get_field( 'link_url', $event->ID );
							$button_new_window = get_field( 'link_new_window', $event->ID );
					?>
					<div class="fs-cell <?php echo $class; ?> fs-all-third">
						<div class="event_wrap clearfix">
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
								<a href="<?php echo get_the_permalink( $event->ID ); ?>"<?php fielding_new_window( $button_new_window ); ?> class="event_link"><span>Event</span> Details</a>
							</div>
						</div>
					</div>
					<?php
							$i++;
						endforeach;
					?>
				</div>
				<br class="clear">
			</div>
		</div>
	</div>
</section>
<header class="page_header">
	<div class="fs-row">
		<div class="fs-cell typography">
			<h1 class="heading_red"><?php echo $page_title; ?></h1>
		</div>
	</div>
</header>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="short_events_wrap clearfix">
				<div class="short_events margined_md_bottom">
					<?php
						$theme_dir = get_template_directory();

						include $theme_dir . "/layouts/partial/events-filters.php";
						include $theme_dir . "/layouts/partial/events-list.php";

						fielding_pagination();
					?>
				</div>
				<div class="margined_top margined_md_bottom contain">
					<a href="<?php fielding_page_link( 'calendar_archives' ); ?>" class="btn btn_gray">View All Events</a>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();
