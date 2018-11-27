<?php
$page_type  = get_field( 'page_type' );
$page_title = get_field( 'page_title' );
$page_intro = get_field( 'page_intro' );
$page_image = get_field( 'page_image' );

if ( ! $page_title ) {
	$page_title = get_the_title();
}

// Image
if ( $page_type == 'image' ) :
	$background_options = fielding_background_header( $page_image );
?>
<div class="fs-row breadcrumb_wrap">
	<div class="fs-cell breadcrumb_overlay">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<header class="page_header page_header_image margined_lg">
	<div class="js-background" data-background-options="<?php fielding_json_attribute( $background_options ); ?>">
		<div class="page_header_content">
			<div class="fs-row">
				<div class="typography page_header_copy">
					<h1><?php echo $page_title; ?></h1>
					<?php if ($page_intro) : ?>
					<p class="intro"><?php echo $page_intro; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
<?php

// Spotlights
elseif ( $page_type == 'spotlight' ) :
	$background_options_large = fielding_background_spotlight_large( $page_image );
	$background_options_small = fielding_background_spotlight_small( $page_image );

	$spotlight_category = get_field( 'page_spotlight_category' );

	$spotlights = get_posts( array(
		'post_type'      => 'spotlights',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'spotlights-categories',
				'field'    => 'term_id',
				'terms'    => $spotlight_category->term_id,
			),
		),
	) );

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
						<h2 class="feature_callout_title"><?php echo $page_title; ?></h2>
					</header>
					<div class="feature_callout_description">
						<p><?php echo $page_intro; ?></p>
					</div>
					<?php
						if ( have_rows( 'page_spotlight_buttons' ) ) :
					?>
					<footer class="feature_callout_buttons">
						<?php
							while ( have_rows( 'page_spotlight_buttons' ) ) :
								the_row();

								$button_icon  = get_sub_field( 'button_icon' );
								$button_title = get_sub_field( 'button_title' );
								$button_link  = get_sub_field( 'button_link' );
								$button_new_window = get_sub_field( 'button_new_window' );
						?>
						<a class="btn feature_callout_button feature_callout_button_<?php echo $button_icon; ?>" href="<?php echo $button_link; ?>"<?php fielding_new_window( $button_new_window ); ?>><?php echo $button_title; ?></a>
						<?php
							endwhile;
						?>
					</footer>
					<?php
						endif;
					?>
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
							if ( array_filter( $spotlights ) ) :

								$c = 0;
								$i = 0;
								foreach ( $spotlights as $spotlight ) :
									$color   = get_field( 'color_option', $spotlight->ID );
									$name    = get_the_title( $spotlight->ID );
									$type    = get_field( 'type', $spotlight->ID );
									$image   = get_field( 'image', $spotlight->ID );
									$content = get_field( 'content', $spotlight->ID );

									$link_title = get_field( 'link_title', $spotlight->ID );
									$link_url   = get_field( 'link_url', $spotlight->ID );
									$link_new_window = get_field( 'link_new_window', $spotlight->ID );

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
								endforeach;
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
// Normal
else :
?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<header class="page_header">
	<div class="fs-row">
		<div class="fs-cell typography">
			<h1><?php echo $page_title; ?></h1>
			<?php if ($page_intro) : ?>
			<p class="intro"><?php echo $page_intro; ?></p>
			<?php endif; ?>
		</div>
	</div>
</header>
<?php
endif;