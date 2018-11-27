<?php
/**
 * Template For Full Width Components - Related Events
 */

if ($acf_fc['acf_fc_layout'] == 'related_events') {
	$acf = $acf_fc;
}

?>
<div class="upcoming_events">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="upcoming_events_inner">
				<header class="upcoming_events_header">
					<a class="upcoming_events_link" terget="_blank" href="<?php echo esc_url($acf['calendar_link']) ?>">
						<span class="upcoming_events_link_label">View All Events</span>
						<span class="upcoming_events_link_icon" aria-hidden="true">
							<svg class="icon icon_arrow_right">
								<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							</svg>
						</span>
					</a>
					<h2 class="upcoming_events_title"><?php echo $acf['events_title'] ?></h2>
				</header>
				<div class="upcoming_events_items">
					<?php echo $acf['livewhale_widget_embed_code'] ?>
				</div>
			</div>
		</div>
	</div>
</div>