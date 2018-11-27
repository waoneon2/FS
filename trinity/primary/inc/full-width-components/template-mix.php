<?php
/**
 * Template For Full Width Components - News and Event
 */
if ($acf_fc['acf_fc_layout'] == 'news_events') {
	$acf = $acf_fc;
}
$posts = $acf['news_article'];
$posts_status = $acf['news_article']['selected_posts'][0]->post_status;

/*$posts_event = $acf['events'];
$posts_event_status = $acf['events']['selected_posts'][0]->post_status;*/
?>

<div class="mix">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="mix_inner">

				<div class="mix_news">
					<header class="mix_news_header">
						<?php if($posts): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<span class="mix_news_link_wrapper mix_news_link_wrapper_lg">
								<a class="mix_news_link" href="<?php echo get_post_type_archive_link( 'news_post' ); ?>">
								    <span class="mix_news_link_label">View All News</span>
								    <span class="mix_news_link_icon" aria-hidden="true">
								        <svg class="icon icon_arrow_right">
								        	<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
								        </svg>
								    </span>
								</a>
							</span>
							<?php restore_current_blog(); ?>
						<?php endif ?>
						<h2 class="mix_news_title"><?php echo $acf['news_title']; ?></h2>
						<span class="mix_news_link_wrapper mix_news_link_wrapper_sm">
						    <a class="mix_news_link" href="#">
						        <span class="mix_news_link_label">View All News</span>
						        <span class="mix_news_link_icon" aria-hidden="true">
						            <svg class="icon icon_arrow_right">
						                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						            </svg>
						        </span>
						    </a>
						</span>
					</header>
					<article class="mix_news_item">
						<?php if ($posts && $posts_status == 'publish'): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<?php foreach( $posts['selected_posts'] as $post): ?>
								<?php setup_postdata($post); ?>
								<?php if(get_field('header_image')): ?>
								<figure class="mix_news_item_figure">
									<a class="mix_news_item_figure_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
										<img class="mix_news_item_image" src="<?php tric_image(get_field('header_image'), '500x282') ?>" alt="image">
									</a>
								</figure>
								<?php endif; ?>
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
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
							<?php restore_current_blog(); ?>
						<?php endif; ?>
					</article>
				</div><!-- .mix_news -->

				<div class="mix_events">
					<header class="mix_events_header">
						<span class="mix_events_link_wrapper mix_events_link_wrapper_lg">
							<a class="mix_events_link" target="_blank" href="<?php echo esc_url($acf['calendar_link']) ?>">
							    <span class="mix_events_link_label">View All Events</span>
							    <span class="mix_events_link_icon" aria-hidden="true">
							        <svg class="icon icon_arrow_right">
							            <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							        </svg>
							    </span>
							</a>
					 	</span>
						<h2 class="mix_events_title"><?php echo $acf['events_title'] ?></h2>
						<span class="mix_events_link_wrapper mix_events_link_wrapper_sm">
						    <a class="mix_events_link" href="<?php echo esc_url($acf['calendar_link']) ?>">
						        <span class="mix_events_link_label">View All Events</span>
						        <span class="mix_events_link_icon" aria-hidden="true">
						            <svg class="icon icon_arrow_right">
						                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						            </svg>
						        </span>
						    </a>
						</span>
					</header>
					<div class="mix_events_items">
						<?php echo $acf['livewhale_widget_embed_code'] ?>
					</div>
				</div> <!-- .mix_events -->

			</div>
		</div>
	</div>
</div>
