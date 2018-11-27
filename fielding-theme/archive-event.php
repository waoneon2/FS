<?php
global $fielding_page_url;
global $fielding_calendar_active;
global $fielding_calendar_page;

$fielding_calendar_active  = true;
$fielding_calendar_page    = ( isset( $fielding_calendar_page ) ) ? $fielding_calendar_page : false;

$paged = get_query_var( 'paged' );

if ( ! isset( $page_title ) ) {
	if ( eo_is_event_archive('day') ) {
		$page_title = eo_get_event_archive_date('jS F Y') . " Events";
		$fielding_calendar_page = $page_title;
	} else if ( eo_is_event_archive('month') ) {
		$page_title = eo_get_event_archive_date('F Y') . " Events";
		$fielding_calendar_page = $page_title;
	} else if ( eo_is_event_archive('year') ) {
		$page_title = eo_get_event_archive_date('Y') . " Events";
		$fielding_calendar_page = $page_title;
	} else {
		$page_title = "Event Archives";
	}
}

$categories = get_terms( 'event-category' );

$dropdown_options = array(
	"links"        => true,
	"customClass" => "base_select events_select events_month_select black_select",
);

get_header();

?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<header class="page_header">
	<div class="fs-row">
		<div class="fs-cell typography">
			<h1 class="heading_red"><?php echo $page_title; ?></h1>
		</div>
	</div>
</header>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav', 'events' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="short_events_wrap clearfix">
				<div class="short_events margined_md_bottom">
					<?php
						$events = $posts;

						$theme_dir = get_template_directory();

						include $theme_dir . "/layouts/partial/events-filters.php";
						include $theme_dir . "/layouts/partial/events-list.php";

						fielding_pagination();
					?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'layouts/sidebar', 'events' ); ?>
	</div>
</div>
<?php

get_footer();
