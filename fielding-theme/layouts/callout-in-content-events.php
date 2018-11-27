<?php
$heading  = get_sub_field( 'heading' );
$category = get_sub_field( 'category' );

$events = eo_get_events(array(
	"numberposts"       => 3,
    "event_start_after" => "today",
    "event-category"    => $category->slug,
));

$category_link = get_term_link( $category );

if ( array_filter( $events ) ):
?>
<article class="short_events_wrap margined_lg clearfix">
	<div class="short_events">
		<header class="events_heading clearfix">
			<h2 class="heading_2"><?php echo $heading; ?></h2>
			<a href="<?php echo $category_link; ?>" class="btn btn_gray">View All Events</a>
		</header>
		<?php
			$theme_dir = get_template_directory();
			include $theme_dir . "/layouts/partial/events-list.php";
		?>
	</div>
</article>
<?php
endif;
