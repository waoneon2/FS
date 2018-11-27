<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

/*
		$background_options_large = fielding_background_spotlight_large( $page_image );
		$background_options_small = fielding_background_spotlight_small( $page_image );
*/

		$background_options_large = array( "source" => fielding_image(false, "wide-lrg") );
		$background_options_small = array( "source" => fielding_image(false, "wide-lrg") );

		$carousel_options = array(
			"contained"  => false,
			"autoHeight" => false,
			"matchHeight" => true,
			"theme" => "controls_circ_lg",
			"show"  => array(
				"740px" => 2,
				"980px" => 1
			),
		);

		$colors = array(
			"teal",
			"gray",
			"red",
			"purple"
		);
?>

<section class="feature_callout">
	<div class="js-background feature_callout_background feature_callout_background_main" data-background-options="<?php fielding_json_attribute( $background_options_large ); ?>"></div>

	<div class="feature_callout_content">
		<div class="js-background feature_callout_background feature_callout_background_content" data-background-options="<?php fielding_json_attribute( $background_options_small ); ?>"></div>
		<div class="fs-row">
			<div class="fs-cell fs-md-5 fs-lg-6">
				<div class="feature_callout_container">
					<header class="feature_callout_header">
						<h2 class="feature_callout_title">Spotlight Preview</h2>
					</header>
					<div class="feature_callout_description">
						<p>Previewing individual spotlight.</p>
					</div>
				</div>
			</div>
			<div class="fs-cell fs-md-3 fs-lg-5 fs-lg-push-1">
				<div class="feature_callout_spotlight_large">

				</div>
			</div>
		</div>
	</div>
	<?php
		$equalize_options = array(
			"target"   => ".equalize_target",
		);
	?>
	<div class="fs-row">
		<div class="fs-cell">
			<div class="feature_callout_spotlight_small">
				<div class="feature_callout_spotlight">
					<div class="js-carousel js-equalize spotlight_carousel" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
						<?php
							$c = 0;
							$i = 0;

							$color   = get_field( 'color_option' );
							$name    = get_the_title();
							$type    = get_field( 'type' );
							$image   = get_field( 'image' );
							$content = get_field( 'content' );

							if ( $name == "" ) {
								$name = get_the_title( $spotlight->ID );
							}

							$link_title = get_field( 'link_title' );
							$link_url   = get_field( 'link_url' );
							$link_new_window = get_field( 'link_new_window' );

							if ( $type != "" ) {
								$type = $type . " ";
							}

							if ( $color == "" ) {
								$color = $colors[$c];
							}
						?>
						<article class="spotlight_card">
							<div class="spotlight_card_inner">
								<figure class="responsive_image spotlight_card_figure">
									<img src="<?php echo fielding_image( $image, 'wide-xsml' ); ?>" alt="" class="spotlight_card_image">
								</figure>
								<div class="spotlight_card_<?php echo $color; ?> equalize_child spotlight_card_content">
									<header class="spotlight_card_header">
										<div class="spotlight_card_label"><?php echo ucwords( $type ); ?>Spotlight</div>
										<h3 class="spotlight_card_title"><?php echo $name; ?></h3>
									</header>
									<div class="spotlight_card_description">
										<p><?php echo $content; ?></p>
									</div>
									<?php
										if ( $link_title && $link_url ) :
									?>
									<div class="spotlight_card_buttons">
										<a class="spotlight_card_button" href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?> aria-label="<?php echo $name; ?>"><?php echo $link_title; ?></a>
									</div>
									<?php
										endif;
									?>
								</div>
							</div>
						</article>

						<?php
							$c++;
							$i++;

							if ($c >= count($colors)) {
								$c = 0;
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page_content_area">
	<div class="fs-row">
		<div class="fs-cell fs-lg-8 page_content">

				<br><br><br>

				<?php
				$local_color = get_sub_field( 'color_option' );
				// $spotlight   = get_sub_field( 'spotlight' );

				$color   = get_field( 'color_option' );
				$name    = get_field( 'title' );
				$image   = get_field( 'image' );
				$type    = get_field( 'type' );
				$content = get_field( 'content' );
				$link_title = get_field( 'link_title' );
				$link_url   = get_field( 'link_url' );
				$link_new_window = get_field( 'link_new_window' );

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

		</div>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();