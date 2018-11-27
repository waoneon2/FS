<?php
$local_color = get_sub_field( 'color_option' );
$spotlight   = get_sub_field( 'spotlight' );

$color   = get_field( 'color_option', $spotlight->ID );
$name    = get_field( 'title', $spotlight->ID );
$image   = get_field( 'image', $spotlight->ID );
$type    = get_field( 'type', $spotlight->ID );
$content = get_field( 'content', $spotlight->ID );
$link_title = get_field( 'link_title', $spotlight->ID );
$link_url   = get_field( 'link_url', $spotlight->ID );
$link_new_window = get_field( 'link_new_window', $spotlight->ID );

if ( $name == "" ) {
	$name = get_the_title( $spotlight->ID );
}

if ( $type != "" ) {
	$type = $type . " ";
}

if ( $local_color != "" ) {
	$color = $local_color;
}

if ( $color == "" ) {
	$color = "teal";
}

$background_options = fielding_background_testimonial( $image );
?>
<article class="testimonial_single_wrap spotlight_wrap">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="slide_wrap slide_<?php echo $color;?>">
				<div class="slide">
					<div class="slide_left fs-cell-contained fs-lg-half fs-md-half fs-sm-full fs-xs-full">
						<div class="slide_image js-background" data-background-options="<?php fielding_json_attribute( $background_options ); ?>"></div>
					</div>
					<div class="slide_right fs-cell-contained fs-lg-half fs-md-half fs-sm-full fs-xs-full">
						<div class="slide_text">
							<h5 class="heading_5"><?php echo ucwords( $type ); ?>Spotlight</h5>
							<p class="slide_bold"><?php echo $name; ?></p>
							<p class="slide_quote"><?php echo $content; ?></p>
							<?php if ( $link_title && $link_url ) : ?>
							<a href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> class="btn btn_transparent_arrow_white"><?php echo $link_title; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>