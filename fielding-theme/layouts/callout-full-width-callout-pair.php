<?php
if ( have_rows( 'callouts' ) ) :
?>
<section class="full_width_callout_wrap margined_lg">
	<div class="fs-row full_width_callout">
		<?php
			while ( have_rows( 'callouts' ) ) :
				the_row();

				$image      = get_sub_field( 'image' );
				$heading    = get_sub_field( 'heading' );
				$content    = get_sub_field( 'content' );
				$link_title = get_sub_field( 'link_title' );
				$link_url   = get_sub_field( 'link_url' );
				$link_new_window = get_sub_field( 'link_new_window' );
		?>
		<div class="fs-cell fs-xs-full fs-all-half">
			<div class="image_wrap">
				<?php fielding_responsive_image( fielding_image_callout_pair( $image ) ); ?>
			</div>
			<h2 class="heading_2 in_image"><?php echo $heading; ?></h2>
			<p><?php echo $content; ?></p>
			<?php
				if ( $link_title && $link_url ) :
			?>
			<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="bold_link"><?php echo $link_title; ?></a>
			<?php
				endif;
			?>
		</div>
		<?php
			endwhile;
		?>
	</div>
</section>
<?php
endif;