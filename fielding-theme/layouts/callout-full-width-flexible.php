<?php
$color      = get_sub_field( 'color_option' );
$gavity     = get_sub_field( 'gravity' );
$label      = get_sub_field( 'label' );
$heading    = get_sub_field( 'heading' );
$content    = get_sub_field( 'content' );
$link_title = get_sub_field( 'button_title' );
$link_url   = get_sub_field( 'button_link' );
$link_new_window = get_sub_field( 'button_link_new_window' );
$image      = get_sub_field( 'image' );
?>
<section class="full_width_wrap">
	<div class="people_feature_theme theme_<?php echo $color; ?>">
		<div class="fs-row full_width">
			<div class="fs-cell<?php if ( $gavity == 'left' ) echo '-right'; ?> fs-xs-full fs-sm-1 fs-md-2 fs-lg-5 image_wrapper">
				<?php fielding_responsive_image( fielding_image_full_flexible( $image ) ); ?>
			</div>
			<div class="fs-cell fs-xs-full fs-sm-2 fs-md-4 fs-lg-7 text_area">
				<h5 class="heading_5"><?php echo $label; ?></h5>
				<h3 class="heading_3"><?php echo $heading; ?></h3>
				<p><?php echo $content; ?></p>
				<?php if ( $link_title && $link_url ) : ?>
				<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="btn btn_transparent_arrow_white"><?php echo $link_title; ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>