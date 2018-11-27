<?php
$image      = get_sub_field( 'image' );
$heading    = get_sub_field( 'heading' );
$content    = get_sub_field( 'content' );
$link_title = get_sub_field( 'link_title' );
$link_url   = get_sub_field( 'link_url' );
$link_new_window = get_sub_field( 'link_new_window' );
?>
<section class="in_content_callout_wrap margined_lg">
	<div class="fs-row in_content_callout">
		<?php
			if ( $image ) :
		?>
		<div class="fs-cell-contained fs-xs-full fs-sm-half fs-md-2 fs-lg-4">
			<?php fielding_responsive_image( fielding_image_topic_block( $image ) ); ?>
		</div>
		<?php
			endif;
		?>
		<div class="fs-cell-contained fs-xs-full fs-sm-half fs-md-4 fs-lg-8">
			<h4 class="heading_4"><?php echo $heading; ?></h4>
			<p><?php echo $content; ?></p>
			<?php if ( $link_title && $link_url ) : ?>
			<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="bold_link"><?php echo $link_title; ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>