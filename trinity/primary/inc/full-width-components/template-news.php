<?php
/**
 * Template For Full Width Components - News
 */
if ($acf_fc['acf_fc_layout'] == 'related_news') {
	$acf = $acf_fc;
}

if ($acf['news']['selected_posts']):
	$posts = $acf['news']['selected_posts'];  ?>

	<?php //print_r($post) ?>
	<div class="news">
		<div class="fs-row">
			<div class="fs-cell fs-xl-10 fs-all-justify-center">
				<div class="news_inner">
					<div class="news_items">

							<?php foreach ($posts as $post): ?>
								<?php setup_postdata( $post ); ?>
								<?php $term = wp_get_post_terms( $post->ID, 'news-category' ); ?>

								<article class="news_item <?php echo get_field('list_image') ? "layout_image" : "layout_no_image" ?>">

									<?php if (get_field('list_image')): ?>
										<figure class="news_item_figure">
											<a class="news_item_figure_link" href="#">
												<img class="news_item_image" src="<?php the_field('list_image') ?>" alt="image">
											</a>
										</figure>
									<?php endif ?>

									<div class="news_item_body">
										<div class="news_item_body_inner">
											<header class="news_item_header">
												<div class="news_item_details">

													<?php if ($term): ?>
														<span class="news_item_detail">
															<span class="news_item_label"><?php echo $term[0]->name ?></span>
														</span>
													<?php endif ?>

														<span class="news_item_detail">
															<span class="news_item_date">posted <time class="news_item_time"><?php the_time('M j') ?></time></span>
														</span>

													<?php if (get_field('author')): ?>
														<span class="news_item_detail news_item_detail_author">
															<span class="news_item_author">by
																<strong class="news_item_author_name">
																	<?php the_field('author') ?><?php echo get_field('source') ? ', ' : '' ?>
																</strong>
															</span>
														</span>
													<?php endif ?>

													<?php if (get_field('source')): ?>
														<span class="news_item_detail">
															<a class="news_item_source" href="<?php echo esc_url(the_field('source')) ?>">source</a>
														</span>
													<?php endif ?>

												</div>
												<h3 class="news_item_title">
													<a class="news_item_title_link" href="<?php the_permalink() ?>">
														<span class="news_item_title_link_label"><?php the_title() ?></span>
														<span class="news_item_title_link_icon" aria-hidden="true">
															<svg class="icon icon_arrow_right">
															    <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
															</svg>
														</span>
													</a>
												</h3>
											</header>
											<div class="news_item_caption"><?php tric_bulrb_autofill() ?></div>
										</div>
									</div>
								</article>
							<?php endforeach ?>
							<?php wp_reset_postdata();?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif ?>