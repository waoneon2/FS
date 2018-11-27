<?php
/**
 * Template For - News Archive
 */

$taxonomy 	 	= 'news-category';
$paged 			= (get_query_var('paged')) ? get_query_var('paged') : 1;
$pages 			= "";
$range 			= get_option('posts_per_page');
$showitems 		= ($range * 2)+1;
$pages 			= "";
$link_prev 		= "";
$link_next 		= "";
$category 		= "";
$big 			= 999999999;

if($pages == '') {
	$pages = $wp_query->max_num_pages;
	if(!$pages) {
		$pages = 1;
	}
}
?>

<div class="news">
	<div class="fs-row">
		<div class="fs-cell fs-xl-10 fs-all-justify-center">
			<div class="news_inner">
				<div class="news_items">

					<?php if (have_posts()): ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php $term = wp_get_post_terms( $post->ID, $taxonomy ); ?>
							<article class="news_item <?php echo get_field('list_image') ? "layout_image" : "layout_no_image" ?>">

								<?php if (get_field('list_image')): ?>
									<figure class="news_item_figure">
										<a class="news_item_figure_link" href="<?php the_permalink() ?>">
											<img class="news_item_image" src="<?php tric_image(get_field('list_image'), '500x375') ?>" alt="image">
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
						<?php endwhile ?>
						<?php wp_reset_postdata();?>
					<?php else: ?>
						<p>No Data</p>
					<?php endif ?>

				</div>
			</div>
		</div>
	</div>
</div>

<?php if(1 != $pages): ?>

	<?php
		if($paged > 1 || $showitems < $pages){
			$link_prev = get_pagenum_link($paged - 1);
		}
		if ($paged < $pages || $showitems < $pages){
			$link_next = get_pagenum_link($paged + 1);
		}
	?>

	<div class="pagination">
		<div class="fs-row">
			<div class="fs-cell fs-xl-10 fs-all-justify-center">
				<div class="pagination_inner">

					<?php if ($link_prev): ?>
					<a class="pagination_arrow pagination_arrow_left" href="<?php echo esc_url($link_prev); ?>">
					<?php else: ?>
					<a class="pagination_arrow pagination_arrow_left pagination_arrow_disabled">
					<?php endif ?>
						<span class="pagination_arrow_label"></span>
						<span class="pagination_arrow_icon">
							<svg class="icon icon_arrow_left">
							    <use xlink:href="<?php tric_icon('arrow_left') ?>"></use>
							</svg>
						</span>
					</a>

					<nav class="pagination_nav">
						<?php for ($i=1; $i <= $pages; $i++) {
							if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
								echo ($paged == $i) ? "<a href='".get_pagenum_link($i)."' class=\"pagination_link active\">".$i."</a>":"<a href='".get_pagenum_link($i)."' class=\"pagination_link\">".$i."</a>";
							}
						} ?>
					</nav>

					<?php if ($link_next): ?>
					<a class="pagination_arrow pagination_arrow_right" href="<?php echo esc_url($link_next); ?>">
					<?php else: ?>
					<a class="pagination_arrow pagination_arrow_right pagination_arrow_disabled">
					<?php endif ?>
						<span class="pagination_arrow_label"></span>
						<span class="pagination_arrow_icon">
							<svg class="icon icon_arrow_right">
							    <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							</svg>
						</span>
					</a>

				</div>

			</div>
		</div>
	</div>
<?php endif ?>