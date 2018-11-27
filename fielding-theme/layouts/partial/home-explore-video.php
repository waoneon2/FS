<?php
$video_params = fielding_youtube_params( $item["video_url"] );
?>
<div class="fs-cell destroy_sm_carousel fs-md-full fs-lg-8">
	<div class="box_wrap">
		<div class="gradient bg_video">
			<div class="box">
				<a class="js-lightbox" href="<?php echo $item["video_url"]; ?><?php echo $video_params; ?>">
					<div class="slide_time_wrap">
						<p class="slide_time"><?php echo $item["length"]; ?></p>
					</div>
					<div class="play_icon"></div>
					<p class="caption"><?php echo $item["title"]; ?></p>
					<?php fielding_responsive_image( fielding_image_home_explore( $item["image"] ) ); ?>
				</a>
			</div>
		</div>
	</div>
</div>