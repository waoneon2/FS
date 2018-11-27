<?php
$video_label  = get_sub_field( 'video_label' );
$video_title  = get_sub_field( 'video_title' );
$video_length = get_sub_field( 'video_length' );
$video_url    = get_sub_field( 'video_url' );
$video_image  = get_sub_field( 'video_image' );

$video_params = fielding_youtube_params( $video );
?>
<header class="people_feature_media_header">
	<h3 class="people_feature_media_title"><?php echo $video_label; ?></h3>
</header>
<div class="people_feature_media_body">
	<a class="js-lightbox people_feature_video_link" href="<?php echo $video_url; ?><?php echo $video_params; ?>">
		<?php echo fielding_responsive_image( fielding_image_home_feature_video( $video_image ), 'people_feature_video_picture', 'people_feature_video_image' ); ?>
		<h4 class="people_feature_video_title">
			<span class="people_feature_video_title_text">
				<span class="play_icon"></span> <?php echo $video_title; ?>
			</span>
		</h4>
		<div class="slide_time_wrap people_feature_video_time">
			<p class="slide_time"><span class="slide_icon"></span><?php echo $video_length; ?></p>
		</div>
	</a>
</div>