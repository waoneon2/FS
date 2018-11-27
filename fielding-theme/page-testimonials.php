<?php
/**
 * Template Name: Testimonials
 */

$testimonials = get_posts( array(
	'post_type'      => 'testimonials',
	'posts_per_page' => -1
) );

$colors = array(
	"teal",
	"gray",
	"red",
	"purple"
);

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'layouts/page-header' );
?>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="typography">
				<?php the_content(); ?>
			</div>

			<div class="margined_lg_bottom">
				<?php
					$c = 0;
					$i = 0;
					foreach ( $testimonials as $testimonial) :
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

						$background_options = fielding_background_testimonial( $image );

						$color = $colors[$c];
				?>
				<article class="testimonial_single_wrap">
					<div class="fs-row">
						<div class="fs-cell">
							<div class="slide_wrap slide_<?php echo $color; ?>">
								<div class="slide">
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
						</div>
					</div>
				</article>
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
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();