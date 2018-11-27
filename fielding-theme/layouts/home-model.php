<?php
$label      = get_field( 'model_label' );
$heading    = get_field( 'model_heading' );
$link_title = get_field( 'model_link_title' );
$link_url   = get_field( 'model_link_url' );
$link_new_window = get_field( 'model_link_new_window' );
$background = get_field( 'model_background' );

$background_options = fielding_background_home_model( $background );

if ( have_rows( 'model_videos' ) ) :
?>
<section class="education_wrap margined_lg">
	<div class="js-background" data-background-options="<?php fielding_json_attribute( $background_options ); ?>">
		<div class="education_model">
			<div class="fs-row education_header">
				<div class="fs-cell fs-all-full">
					<h2 class="media_carousel_label"><?php echo $label; ?></h2>
					<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
					<a href="<?php echo $link_url; ?>" class="btn btn_light"<?php fielding_new_window( $link_new_window ); ?>><?php echo $link_title; ?></a>
				</div>
			</div>
			<div class="education_box_wrap clearfix">
				<?php
					$colors = array(
						"red",
						"gray",
						"purple",
						"teal",
					);
					$i = 0;
					while ( have_rows( 'model_videos' ) ) :
						the_row();

						$heading = get_sub_field( 'heading' );
						$intro   = get_sub_field( 'intro' );
						$quote   = get_sub_field( 'quote' );
						$name    = get_sub_field( 'name' );
						$title   = get_sub_field( 'title' );
						$image   = get_sub_field( 'image' );
						$length  = get_sub_field( 'length' );
						$video   = get_sub_field( 'video_url' );

						$video_params = fielding_youtube_params( $video );
				?>
				<div class="education_box">
					<div class="education_inner">
						<div class="education_img">
							<a class="education_link js-lightbox" href="<?=$video?><?php echo $video_params; ?>">
								<?php fielding_responsive_image( fielding_image_home_model( $image ) ); ?>
								<div class="play_icon"></div>
							</a>
						</div>
						<div class="color bg_dk_<?php echo $colors[$i]; ?>">
							<div class="education_text">
								<h3 class="heading_3"><?php echo $heading; ?></h3>
								<p class="education_desc"><?php echo $intro; ?></p>
								<div class="education_hide">
									<p class="education_quote"><?php echo $quote; ?></p>
									<p class="education_name"><?php echo $name; ?>, <?php echo $title; ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="slide_time_wrap">
						<p class="hide_lg watch_link">Watch The Video</p>
						<a href="<?php echo $video_url; ?>" class="slide_time"><span class="slide_icon"></span><?php echo $length; ?></a>
					</div>
				</div>
				<?php
						$i++;
					endwhile;
				?>
			</div>
		</div>
	</div>
</section>
<?php
endif;