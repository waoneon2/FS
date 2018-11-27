<?php
/**
 * Template For in content component  - topic row
 */
if ($acf_fc['acf_fc_layout'] == 'topic_rows') {
	$acf = $acf_fc;
}
?>

<div class="topic_block">
	<div class="topic_items">
		<?php if ($acf['rows']): ?>
			<?php foreach ($acf['rows'] as $topic_rows) : ?>
				<article class="topic_item">
					<div class="topic_item_inner">
						<figure class="topic_figure">
							<?php if (isset($topic_rows['image']) && $topic_rows['image']) { ?>
								<?php if (isset($topic_rows['video_url']) && $topic_rows['video_url']): ?>
									<a class="js-lightbox topic_figure_link" href="<?php echo tric_video_support::render_video($topic_rows['video_url'], true) ?>" >
										<img class="topic_image" src="<?php tric_image($topic_rows['image'], '500x334') ?>" alt="image">
										<span class="topic_video_button">
											<span class="topic_video_button_icon">
												<svg class="icon icon_play">
													<use xlink:href="<?php tric_icon('play') ?>"></use>
												</svg>
											</span>
										</span>
									</a>
								<?php else: ?>
									<a class="topic_figure_link" <?php tric_tblank($topic_rows['link_url']) ?> href="<?php echo esc_url($topic_rows['link_url']) ?>">
										<img class="topic_image" src="<?php tric_image($topic_rows['image'], '500x334') ?>" alt="image">
									</a>
								<?php endif ?>
							<?php } ?>
						</figure>
						<div class="topic_wrapper">
							<header class="topic_header">
								<h2 class="topic_title">
									<a class="topic_title_link" <?php tric_tblank($topic_rows['link_url']) ?> href="<?php echo esc_url($topic_rows['link_url']) ?>">
										<?php echo $topic_rows['title'];?>
									</a>
							  </h2>
							</header>
							<div class="topic_body">
								<div class="topic_caption">
									<p><?php echo $topic_rows['blurb'];?></p>
								</div>
							</div>
							<footer class="topic_footer">
								<a class="topic_link" <?php tric_tblank($topic_rows['link_url']) ?> href="<?php echo esc_url($topic_rows['link_url']) ?>">
									<span class="topic_link_label"><?php echo $topic_rows['link_title'] ?></span>
									<span class="topic_link_icon" aria-hidden="true">
										<svg class="icon icon_arrow_right">
							                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							            </svg>
									</span>
								</a>
							</footer>
						</div>
					</div>
				</article>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</div>
