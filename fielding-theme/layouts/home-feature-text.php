<?php
$text_label   = get_sub_field( 'text_label' );
$text_title   = get_sub_field( 'text_title' );
$text_content = get_sub_field( 'text_content' );
$text_button_title = get_sub_field( 'text_button_title' );
$text_button_url   = get_sub_field( 'text_button_url' );
$text_button_new_window = get_sub_field( 'text_button_new_window' );
?>
<header class="people_feature_media_header">
	<h3 class="people_feature_media_title"><?php echo $text_label; ?></h3>
</header>
<div class="people_feature_media_body">
	<div class="people_feature_content">
		<header class="people_feature_content_header">
			<h4 class="people_feature_content_heading" id="people_feature_content_heading"><?php echo $text_title; ?></h4>
		</header>
		<div class="people_feature_content_description">
			<p><?php echo $text_content; ?></p>
		</div>
		<a class="people_feature_content_button" href="<?php echo $text_button_url; ?>"<?php fielding_new_window( $link_new_window ); ?> aria-labelledby="people_feature_content_heading"><?php echo $text_button_title; ?></a>
	</div>
</div>