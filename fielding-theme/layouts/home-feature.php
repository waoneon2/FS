<?php
if ( have_rows( 'home_features' ) ) :

	$home_features = array();

	while ( have_rows( 'home_features' ) ) :
		the_row();

		ob_start();

		$color = get_sub_field( 'color_option' );
		$type  = get_sub_field( 'type' );
		$name  = get_sub_field( 'name' );
		$intro = get_sub_field( 'intro_content' );

		$image         = get_sub_field( 'image' );
		$image_label   = get_sub_field( 'image_label' );
		$image_content = get_sub_field( 'image_content' );
		$image_button  = get_sub_field( 'image_button_title' );

		$school   = get_sub_field( 'school' );
		$programs = get_sub_field( 'programs' );
?>
	<div class="people_feature_theme theme_<?php echo $color; ?>">
		<h2 class="people_feature_section_title visually_hidden"><?php echo $name; ?></h2>
		<figure class="people_feature_figure people_feature_figure_small">
			<?php echo fielding_responsive_image( fielding_image_home_feature_small( $image ), 'people_feature_picture', 'people_feature_image' ); ?>
		</figure>
		<div class="fs-row">
			<div class="fs-cell">
				<div class="people_feature_left" aria-live="polite">
					<div class="equalize_child people_feature_left_wrapper">
						<button class="js-toggle_handle people_feature_name_button" aria-label="Return to previous view">
							<span class="people_feature_name"><?php echo $name; ?></span>
						</button>
						<div class="people_feature_text">
							<div class="people_feature_view_default">
								<div class="people_feature_description"><?php echo $intro; ?></div>
								<button class="people_feature_mobile_toggle"><?php echo $image_button; ?></button>
							</div>
							<div class="people_feature_view_toggle" aria-hidden="true">
								<div class="people_feature_links">
									<div class="people_feature_link_list" aria-label="School" role="list">
										<header class="people_feature_link_list_header">
											<h3 class="people_feature_link_list_title">School</h3>
										</header>
										<?php if ( $school ) : ?>
										<div class="people_feature_link_list_item" role="listitem">
											<a class="people_feature_link_list_link" href="<?php echo get_the_permalink( $school->ID ); ?>"><?php echo $school->post_title; ?></a>
										</div>
										<?php endif; ?>
									</div>
									<div class="people_feature_link_list" aria-label="Programs Available" role="list">
										<header class="people_feature_link_list_header">
											<h3 class="people_feature_link_list_title">Programs Available</h3>
										</header>
										<?php
											if ( $programs ) :
												foreach ( $programs as $program ) :
													$program = $program["program"];
										?>
										<div class="people_feature_link_list_item" role="listitem">
											<a class="people_feature_link_list_link" href="<?php echo get_the_permalink( $program->ID ); ?>"><?php echo $program->post_title; ?></a>
										</div>
										<?php
												endforeach;
											endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="people_feature_right">
					<div class="people_feature_media">
						<div class="people_feature_view_default">
							<figure class="people_feature_figure people_feature_figure_large">
								<?php echo fielding_responsive_image( fielding_image_home_feature_large( $image ), 'people_feature_picture', 'people_feature_image' ); ?>
							</figure>
							<div class="people_feature_caption">
								<header class="people_feature_caption_header">
									<h3 class="people_feature_caption_label"><?php echo $image_label; ?></h3>
								</header>
								<div class="people_feature_caption_content"><?php echo $image_content; ?></div>
								<button class="js-toggle_handle people_feature_caption_button"><?php echo $image_button; ?></button>
							</div>
						</div>
						<div class="people_feature_view_toggle equalize_child" aria-hidden="true">
							<?php
								get_template_part( 'layouts/home-feature', $type );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="people_feature_overlay theme_<?php echo $color; ?>" role="dialog" aria-hidden="true">
		<div class="fs-row">
			<div class="fs-cell">
				<div class="people_feature_overlay_wrapper">
					<button class="people_feature_overlay_close">
						<span class="visually_hidden people_feature_overlay_close_label">close</span>
					</button>
					<div class="people_feature_overlay_caption">
						<header class="people_feature_caption_header">
							<h3 class="people_feature_caption_label"><?php echo $image_label; ?></h3>
						</header>
						<div class="people_feature_caption_content"><?php echo $image_content; ?></div>
					</div>
					<div class="people_feature_overlay_media">
						<header class="people_feature_media_header">
							<h3 class="people_feature_media_title"><?php echo $image_button; ?></h3>
						</header>
						<div class="people_feature_media_body">
							<?php
								get_template_part( 'layouts/home-feature', $type );
							?>
						</div>
					</div>
					<div class="people_feature_links">
						<div class="people_feature_link_list" aria-label="Related School" role="list">
							<header class="people_feature_link_list_header">
								<h3 class="people_feature_link_list_title">School</h3>
							</header>
							<?php if ( $school ) : ?>
							<div class="people_feature_link_list_item" role="listitem">
								<a class="people_feature_link_list_link" href="<?php echo get_the_permalink( $school->ID ); ?>"><?php echo $school->post_title; ?></a>
							</div>
							<?php endif; ?>
						</div>
						<div class="people_feature_link_list" aria-label="Related Programs" role="list">
							<header class="people_feature_link_list_header">
								<h3 class="people_feature_link_list_title">Programs Available</h3>
							</header>
							<?php
								if ( $programs ) :
									foreach ( $programs as $program ) :
										$program = $program["program"];
							?>
							<div class="people_feature_link_list_item" role="listitem">
								<a class="people_feature_link_list_link" href="<?php echo get_the_permalink( $program->ID ); ?>"><?php echo $program->post_title; ?></a>
							</div>
							<?php
									endforeach;
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		$home_features[] = ob_get_clean();

	endwhile;

	$equalize_options = array(
		"target"   => ".equalize_child",
		"minWidth" => "500px"
	);
?>
<section class="js-toggle people_feature_section js-equalize" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
</section>
<script>
	var HomeFeatureData = <?php echo json_encode( $home_features ); ?>
</script>
<?php
endif;