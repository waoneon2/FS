<?php
$heading = get_sub_field( 'heading' );

if ( have_rows( 'links' ) ) :
?>
<div class="fs-row">
	<div class="fs-cell">
		<article class="related_links margined_lg clearfix">
			<h3 class="heading_3 heading_line"><?php echo $heading; ?></h3>
			<div class="fs-row">
				<div class="fs-cell">
					<?php
					while ( have_rows( 'links' ) ) :
						the_row();

						$link_text = get_sub_field( 'link_text' );
						$link_url   = get_sub_field( 'link_url' );
						$link_new_window = get_sub_field( 'link_new_window' );
					?>
					<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="btn btn_gray"><?php echo $link_text; ?></a>
					<?php
					endwhile;
					?>
				</div>
			</div>
		</article>
	</div>
<?php
endif;