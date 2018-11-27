<?php
$image      = get_sub_field( 'image' );
$heading    = get_sub_field( 'heading' );
$content    = get_sub_field( 'content' );
$link_title = get_sub_field( 'link_title' );
$link_url   = get_sub_field( 'link_url' );
$link_new_window = get_sub_field( 'link_new_window' );
$color      = get_sub_field( 'color_option' );
?>
<article class="sidebar_callout_wrap sidebar_component margined_md">
	<?php
		if ( $image ) :
			fielding_responsive_image( fielding_image_sidebar_flexible( $image ) );
		endif;
	?>
	<div class="sidebar_callout sidebar_img sidebar_<?php echo $color; ?>">
		<div class="sidebar_content">
			<h4 class="heading_dashed"><?php echo $heading; ?></h4>
			<p><?php echo $content; ?></p>
			<?php
				if ( $link_title && $link_url ) :
			?>
			<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="btn btn_transparent_arrow"><?php echo $link_title; ?></a>
			<?php
				endif;
			?>
		</div>
	</div>
</article>