<?php
$link_url = get_the_permalink( $item->ID );
?>
<div class="fs-cell destroy_sm_carousel fs-md-2 fs-lg-4 pin_bottom">
	<div class="box_wrap">
		<div class="gradient bg_teal">
			<div class="box">
				<a href="<?php echo $link_url; ?>" class="btn btn_transparent">Featured News</a>
				<h5 class="date"><?php echo get_the_date( 'F j, Y', $item->ID ); ?></h5>
				<a href="<?php echo $link_url; ?>" class="link_title"><?php echo get_the_title( $item->ID ); ?><span class="btn btn_no_border">Read Article</span></a>
			</div>
		</div>
	</div>
</div>