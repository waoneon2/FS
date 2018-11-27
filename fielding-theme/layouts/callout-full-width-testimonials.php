<?php
$label    = get_sub_field( 'label' );
$heading  = get_sub_field( 'heading' );
$category = get_sub_field( 'category' );

$testimonials = get_posts( array(
	'post_type'      => 'testimonials',
	'posts_per_page' => 5,
	'tax_query'      => array(
		array(
			'taxonomy' => 'testimonials-categories',
			'field'    => 'term_id',
			'terms'    => $category->term_id,
		),
	),
) );

$carousel_options = array(
	"theme" => "combo_pager",
	"contained"   => false,
	"matchHeight" => false
);

$colors = array(
	"teal",
	"gray",
	"red",
	"purple"
);

if ( array_filter( $testimonials ) ) :
?>
<article class="testimonial_wrap">
	<div class="fs-row">
		<div class="fs-cell">
			<h2 class="media_carousel_label"><?php echo $label; ?></h2>
			<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
			<div class="js-carousel carousel_video" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>">
				<?php
					$c = 0;
					$i = 0;
					foreach ( $testimonials as $testimonial) :
						$color    = get_field( 'color_option', $testimonial->ID );
						$name     = get_field( 'title', $testimonial->ID );
						$position = get_field( 'position', $testimonial->ID );
						$degree   = get_field( 'degree', $testimonial->ID );
						$image    = get_field( 'image', $testimonial->ID );
						$quote    = get_field( 'quote', $testimonial->ID );
						$video    = get_field( 'video_url', $testimonial->ID );
						$time     = get_field( 'video_length', $testimonial->ID );

						if ( $name == "" ) {
							$name = get_the_title( $testimonial->ID );
						}

						$size = ($i == 0) ? "slide_large" : "";

						$background_options = fielding_background_testimonial( $image );

						if ( $color == "" ) {
							$color = $colors[$c];
						}
				?>
				<div class="slide_wrap <?php echo $size; ?> bg_<?php echo $color; ?>">
					<div class="slide clearfix">
						<div class="slide_left fs-cell-contained fs-lg-half fs-md-half fs-sm-full fs-xs-full">
							<?php
								if ( $video ) :
							?>
							<a class="slide_image js-lightbox js-background" href="<?php echo $video; ?>&autoplay=1&fs=1" data-background-options="<?php fielding_json_attribute( $background_options ); ?>">
								<div class="slide_time_wrap">
									<p class="slide_time"><span class="slide_icon"></span><?php echo $time; ?></p>
								</div>
								<div class="slide_play"></div>
							</a>
							<?php
								else :
							?>
							<div class="slide_image js-background" data-background-options="<?php fielding_json_attribute( $background_options ); ?>"></div>
							<?php
								endif;
							?>
						</div>
						<div class="slide_right fs-cell-contained fs-lg-half fs-md-half fs-sm-full fs-xs-full">
							<div class="slide_text">
								<p class="slide_quote">"<?php echo $quote; ?>"</p>
								<p class="slide_bold"><?php echo $name; ?><?php if ($position) { echo ', ' . $position; } ?></p>
								<p class="slide_caps"><?php echo $degree; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
						$c++;
						$i++;

						if ($c >= count($colors)) {
							$c = 0;
						}
					endforeach;
				?>
			</div>
		</div>
	</div>
</article>
<?php
endif;