<?php
/**
 * Template For Full Width Components - Related News
 */

if ($acf_fc['acf_fc_layout'] == 'related_news') {
	$acf = $acf_fc['related_news_category'];
}

if(get_current_blog_id() > 1){
	switch_to_blog(1);
	$args = array(
		'post_type' 	=> 'news_post',
		'numberposts' 	=> 3,
		'tax_query' 	=> array(
			array(
				'taxonomy' => $acf->taxonomy,
				'field' => 'slug',
				'terms' => $acf->slug
			)
		)
	);
	$posts 		= get_posts( $args );
	$post_len 	= count($posts);
	restore_current_blog();
} else {
	$args = array(
		'post_type' 	=> 'news_post',
		'numberposts' 	=> 3,
		'tax_query' 	=> array(
			array(
				'taxonomy' => $acf->taxonomy,
				'field' => 'slug',
				'terms' => $acf->slug
			)
		)
	);
	$posts 		= get_posts( $args );
	$post_len 	= count($posts);
}
?>

<?php if ($posts) : ?>

<div class="related_news layout_<?php echo $post_len ?>">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="related_news_inner">

				<header class="related_news_header">
					<?php if(get_current_blog_id() > 1): ?>
						<?php switch_to_blog(1); ?>
						<a class="related_news_link" href="<?php echo get_post_type_archive_link( 'news_post' ); ?>">
							<span class="related_news_link_label">View All News</span>
							<span class="related_news_link_icon" aria-hidden="true">
								<svg class="icon icon_arrow_right">
									<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
								</svg>
							</span>
						</a>
						<?php restore_current_blog(); ?>
					<?php else: ?>
					<a class="related_news_link" href="<?php echo get_post_type_archive_link( 'news_post' ); ?>">
						<span class="related_news_link_label">View All News</span>
						<span class="related_news_link_icon" aria-hidden="true">
							<svg class="icon icon_arrow_right">
								<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							</svg>
						</span>
					</a>
					<?php endif; ?>
					<h2 class="related_news_title">Related Articles</h2>
				</header>

				<?php if ($post_len == 3): ?>
				<div class="js-carousel related_news_items" data-carousel-options='{
					"contained": false,
					"controls": false,
					"matchHeight": true,
					"show": {
						"740px": 2,
						"980px": 3
					}
				}'>
				<?php elseif ($post_len == 2): ?>
				<div class="js-carousel related_news_items" data-carousel-options='{
					"contained": false,
					"controls": false,
					"matchHeight": true,
					"show": {
						"740px": 2
					}
				}'>
				<?php else: ?>
				<div class="related_news_items">
				<?php endif; ?>
					<?php if(get_current_blog_id() > 1): ?>
						<?php switch_to_blog(1); ?>
						<?php foreach ($posts as $i => $post): ?>
						<?php setup_postdata( $post ); ?>
							<div class="related_news_item">
								<article class="mix_news_item">

									<?php if ($post_len == 1): ?>
										<?php if (get_field('list_image')): ?>
											<a class="related_news_item_background_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
												<div class="js-background related_news_item_background" data-background-options='{"source": {
												"0px": "<?php tric_image(get_field('list_image'), '500x282') ?>"}}'></div>
											</a>
										<?php endif ?>
									<?php endif ?>

									<?php if (get_field('list_image')): ?>
									<figure class="mix_news_item_figure ">
											<a class="mix_news_item_figure_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
												<img class="mix_news_item_image" src="<?php tric_image(get_field('list_image'), '500x282') ?>" alt="image">
											</a>
									</figure>
									<?php endif ?>

									<div class="mix_news_item_body">
										<header class="mix_news_item_header">
											<h3 class="mix_news_item_title">
												<a class="mix_news_item_title_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
													<span class="mix_news_item_title_link_label"><?php the_title(); ?></span>
													<span class="mix_news_item_title_link_icon" aria-hidden="true">
														<svg class="icon icon_arrow_right">
															<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
														</svg>
													</span>
												</a>
											</h3>
										</header>
										<div class="mix_news_item_caption"><?php tric_bulrb_autofill() ?></div>
									</div>
								</article>
							</div>
						<?php endforeach ?>
						<?php wp_reset_postdata();?>
						<?php restore_current_blog(); ?>
					<?php else: ?>
					<?php foreach ($posts as $i => $post): ?>
						<?php setup_postdata( $post ); ?>
						<div class="related_news_item">
							<article class="mix_news_item">
								<?php if ($post_len == 1): ?>
									<?php if (get_field('list_image')): ?>
									<a class="related_news_item_background_link" href="<?php the_permalink(); ?>">
										<div class="js-background related_news_item_background" data-background-options='{"source": {
										"0px": "<?php tric_image(get_field('list_image'), '500x282') ?>"}}'></div>
									</a>
									<?php endif ?>
								<?php endif ?>

								<?php if (get_field('list_image')): ?>
									<figure class="mix_news_item_figure">
										<a class="mix_news_item_figure_link" href="<?php the_permalink(); ?>">
											<img class="mix_news_item_image" src="<?php tric_image(get_field('list_image'), '500x282'); ?>" alt="image">
										</a>
									</figure>
								<?php endif ?>

								<div class="mix_news_item_body">
									<header class="mix_news_item_header">
										<h3 class="mix_news_item_title">
											<a class="mix_news_item_title_link" href="<?php the_permalink(); ?>">
												<span class="mix_news_item_title_link_label"><?php the_title(); ?></span>
												<span class="mix_news_item_title_link_icon" aria-hidden="true">
													<svg class="icon icon_arrow_right">
														<use xlink:href="<?php tric_icon('arrow_right'); ?>"></use>
													</svg>
												</span>
											</a>
										</h3>
									</header>
									<div class="mix_news_item_caption"><?php tric_bulrb_autofill(); ?></div>
								</div>
							</article>
						</div>
					<?php endforeach ?>
					<?php wp_reset_postdata();?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>
