<?php
/**
 * Template For Full Width Components - Gallery
 */
if ($acf_fc['acf_fc_layout'] == 'media_gallery') {
	$acf = $acf_fc;
}
?>
<div class="media_gallery">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="js-swap media_gallery_inner" data-swap-target=".media_gallery_body" data-swap-group="media_gallery" data-swap-linked="media_gallery">
				<div class="js-background media_gallery_background" data-background-options='{"source": {
				"0px": "<?php tric_image($acf['background'], '740x740') ?>",
				"500px": "<?php tric_image($acf['background'], '740x416') ?>",
				"740px": "<?php tric_image($acf['background'], '980x654') ?>",
				"980px": "<?php tric_image($acf['background'], '1220x686') ?>",
				"1220px": "<?php tric_image($acf['background'], '1220x523') ?>"
				}}'></div>
				<header class="media_gallery_header">
					<button class="js-swap media_gallery_trigger" title="open gallery" data-swap-target=".media_gallery_body" data-swap-group="media_gallery" data-swap-linked="media_gallery">
						<span class="media_gallery_trigger_icon">
							<svg class="icon icon_stretcher">
								<use xlink:href="<?php tric_icon('stretcher') ?>"></use>
							</svg>
						</span>
					</button>
					<div class="media_gallery_details">
						<span class="media_gallery_label">Explore the Gallery</span>
						<h2 class="media_gallery_title"><?php echo $acf['title'] ?></h2>
					</div>
					<div class="media_gallery_count">
						<span class="media_gallery_count_icon">
							<svg class="icon icon_grid">
								<use xlink:href="<?php tric_icon('grid') ?>"></use>
							</svg>
						</span>
						<span class="media_gallery_count_label"><?php echo sizeof($acf['gallery']); ?></span>
					</div>
				</header>
			</div>
			<div class="media_gallery_body">
				<button class="js-swap media_gallery_close" title="open gallery" data-swap-target=".media_gallery_body" data-swap-group="media_gallery" data-swap-linked="media_gallery">
					<span class="media_gallery_close_icon">
						<svg class="icon icon_close">
							<use xlink:href="<?php tric_icon('close') ?>"></use>
						</svg>
					</span>
				</button>
				<div class="media_gallery_body_inner">
					<div class="media_gallery_body_contents">
						<div class="media_gallery_body_header">
							<div class="media_gallery_body_details">
								<span class="media_gallery_body_label">Explore the Gallery</span>
								<h3 class="media_gallery_body_title"><?php echo $acf['title'] ?></h3>
							</div>
							<div class="media_gallery_item_stickers" aria-hidden="true">
								<?php foreach ($acf['gallery'] as $i => $acf_gallery): ?>
									<div class="media_gallery_item_sticker">
										<span class="media_gallery_item_count"><?php echo ($i + 1) ." / ". sizeof($acf['gallery']); ?></span>
										<div class="media_gallery_item_caption">
											<p><?php echo $acf_gallery['caption'] ?></p>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
						<div class="media_gallery_items">

				            <?php foreach ($acf['gallery'] as $i => $acf_gallery): ?>

				            	<?php if ($acf_gallery['type'] == 'video'): ?>
						            <div class="media_gallery_item">
						                <figure class="media_gallery_item_figure">
						                    <img class="media_gallery_item_image" src="<?php echo $acf_gallery['placeholder_image'] ?>" alt="image">
						                    <button class="video_item_video" title="play video" data-url="<?php echo tric_video_support::render_video($acf_gallery['video']); ?>">
						                        <span class="video_item_video_hint">
						                            <span class="video_item_video_hint_icon_bubble">
						                                <span class="video_item_video_hint_icon">
						                                    <svg class="icon icon_play">
						                                        <use xlink:href="<?php tric_icon('play') ?>"></use>
						                                    </svg>
						                                </span>
						                            </span>
						                            <span class="video_item_video_hint_label">Watch the Video</span>
						                        </span>
						                    </button>
						                </figure>
						                <div class="media_gallery_item_details">
						                    <span class="media_gallery_item_count"><?php echo ($i + 1) ." / ". sizeof($acf['gallery']); ?></span>
						                    <div class="media_gallery_item_caption">
						                        <p><?php echo $acf_gallery['caption'] ?></p>
						                    </div>
						                </div>
						            </div>
					        	<?php endif ?>

					        	<?php if ($acf_gallery['type'] == 'image'): ?>
						        	<div class="media_gallery_item">
						        	    <figure class="media_gallery_item_figure">
						        	        <img class="media_gallery_item_image" src="<?php echo $acf_gallery['image'] ?>" alt="image">
						        	    </figure>
						        	    <div class="media_gallery_item_details">
						        	        <span class="media_gallery_item_count"><?php echo ($i + 1) ." / ". sizeof($acf['gallery']); ?></span>
						        	        <div class="media_gallery_item_caption">
						        	            <p><?php echo $acf_gallery['caption'] ?></p>
						        	        </div>
						        	    </div>
						        	</div>
						        <?php endif ?>

				            <?php endforeach ?>

				        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
