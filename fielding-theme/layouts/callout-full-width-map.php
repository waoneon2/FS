<?php
$label   = get_sub_field( 'label' );
$heading = get_sub_field( 'heading' );
$intro   = get_sub_field( 'intro' );

/*
$callout_heading      = get_sub_field( 'callout_heading' );
$callout_content      = get_sub_field( 'callout_content' );
$callout_button_title = get_sub_field( 'callout_button_title' );
$callout_button_link  = get_sub_field( 'callout_button_link' );
$callout_button_new_window = get_sub_field( 'callout_button_new_window' );
*/

?>
<div class="fs-row">
	<div class="fs-cell">
		<article class="map_wrap margined_md">
			<div class="fs-row">
				<div class="fs-cell fs-all-full">
					<h2 class="media_carousel_label"><?php echo $label; ?></h2>
					<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
					<p class="larger"><?php echo $intro; ?></p>
				</div>
			</div>
		</article>
		<div class="map_container">
			<div class="alumni_map_container js-map"></div>
			<div class="alumni_map_details_container js-map_info_window">
				<button class="alumni_map_details_close js-map_info_window_close"></button>
				<article class="alumni_map_details js-map_info_window_details"></article>
			</div>
<!--
			<div class="add_wrap">
				<h4 class="heading_dashed"><?php echo $callout_heading; ?></h4>
				<p><?php echo $callout_content; ?></p>
				<?php if ( $callout_button_title && $callout_button_link ) : ?>
				<a href="<?php echo $callout_button_title; ?>"<?php fielding_new_window( $callout_button_new_window ); ?> class="btn btn_gray btn_drk"><?php echo $callout_button_title; ?></a>
				<?php endif; ?>
			</div>
-->
			<script>
				<?php
					$points = array();
					$pins = get_posts( array(
						'posts_per_page' => -1,
						'post_type'      => 'mappins',
					) );

					foreach ( $pins as $pin ) {
						$coords = get_field( 'coordinates', $pin->ID );

						$points[] = array(
							"id"         => $pin->ID,
							"name"       => get_the_title( $pin->ID ),
							"image"      => fielding_image( get_field( 'image', $pin->ID ), "square-xsml"),
							"location"   => get_field( 'location', $pin->ID ),
							"title"      => get_field( 'title', $pin->ID ),
							"graduation" => get_field( 'graduation', $pin->ID ),
							"degree"     => get_field( 'degree', $pin->ID ),
							"latitude"   => $coords['lat'],
							"longitude"  => $coords['lng'],
						);
					}
				?>
				var MapBrowserData = <?php echo json_encode( $points ); ?>
			</script>
		</div>
	</div>
</div>