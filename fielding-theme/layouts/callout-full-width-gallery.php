<?php
$label   = get_sub_field( 'label' );
$heading = get_sub_field( 'heading' );
$gallery = get_sub_field( 'gallery' );

if ( array_filter($gallery) ) :
?>
<section class="media_carousel_section">
	<header class="media_carousel_header">
		<div class="fs-row destroy_md">
			<div class="fs-cell destroy_md">
				<h2 class="media_carousel_label"><?php echo $label; ?></h2>
				<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
			</div>
		</div>
	</header>
	<div class="media_carousel_body">
		<div class="fs-row destroy_md">
			<div class="fs-cell destroy_md">
				<?php
					$carousel_options = array(
						"theme"      => "combo_pager",
						"autoHeight" => true,
						"single"     => true,
						"contained"  => false
					);
				?>
				<div class="media_carousel_full">
					<div class="js-carousel js-linked-carousel media_carousel" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>">
						<?php
							foreach ( $gallery as $image ):
						?>
						<div class="media_carousel_item media_carousel_full_item">
							<figure class="media_carousel_full_figure">
								<?php echo fielding_responsive_image( fielding_image_gallery( $image ), 'media_carousel_full_picture' ); ?>
								<figcaption class="media_carousel_caption media_carousel_full_caption">
									<?php echo $image['caption']; ?>
								</figcaption>
							</figure>
						</div>
						<?php
							endforeach;
						?>
					</div>
				</div>
				<?php
					$carousel_options = array(
						"theme"      => "controls_circ_lg",
						"autoHeight" => true,
						"pagination" => false,
						"single"     => true,
						"contained"  => false
					);
				?>
				<div class="js-carousel-counter media_carousel_captions" aria-hidden="true">
					<header class="media_carousel_captions_header">
						<div class="carousel_count media_carousel_count">
							<span class="carousel_count_index media_carousel_index"></span> of <span class="carousel_count_total media_carousel_total"></span>
						</div>
					</header>
					<div class="js-carousel js-linked-carousel-sibling media_carousel" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>">
						<?php
							foreach ( $gallery as $image ):
						?>
						<div class="media_carousel_item media_carousel_captions_item">
							<p class="media_carousel_caption media_carousel_captions_caption"><?php echo $image['caption']; ?></p>
						</div>
						<?php
							endforeach;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
endif;
