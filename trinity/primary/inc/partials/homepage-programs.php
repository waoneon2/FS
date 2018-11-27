<?php
/**
 *  Homepage - Programs item
 */

$item = 'programs';
$programs_post = get_posts( array(
	'posts_per_page' 	=> -1,
	'post_type' 		=> 'programs_post',
	'orderby' 			=> 'title',
	'order'				=> 'ASC'
) );
?>

<!-- spotlight_takeover_mini_filter -->
<div class="spotlight_takeover_mini_filter">
	<div class="spotlight_takeover_mini_filter_inner">
		<div class="input_wrapper spotlight_takeover_mini_input_wrapper">
			<input class="input_field spotlight_takeover_mini_input_field" type="search" id="search_by_keyword_mini" placeholder="Search by keyword" />
			<label class="input_label spotlight_takeover_mini_input_label">Search by keyword</label>
		</div>
		<select class="spotlight_takeover_mini_select">
			<option value="0">View All Programs</option>
			<?php foreach ($program_terms as $program_term): ?>
				<option value="<?php echo $program_term->slug ?>" data-taxname="<?php echo $program_term->name ?>">
					<?php echo $program_term->name ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>
</div>

<!-- Programs -->
<div class="spotlight_takeover_item spotlight_takeover_item_1 theme_sea layout_pair layout_filters">
	<span class="spotlight_takeover_content_progress"></span>
	<button class="js-swap spotlight_takeover_item_close" data-swap-target="spotlight_takeover_item_1" data-swap-group="spotlight_takeover" title="close spotlight takeover">
		<span class="spotlight_takeover_item_close_icon">
			<svg class="icon icon_close">
				<use xlink:href="<?php tric_icon('close') ?>"></use>
			</svg>
		</span>
	</button>
	<div class="spotlight_takeover_intro spotlight_takeover_intro_original">
		<div class="js-background spotlight_takeover_intro_background" data-background-options='{"source": {
		"740px": "<?php  tric_image(get_field($item)['image'], '735x980') ?>",
		"980px": "<?php  tric_image(get_field($item)['image'], '980x1220') ?>"
		}}'></div>
		<div class="spotlight_takeover_intro_header">
			<h3 class="spotlight_takeover_intro_label"><?php echo $item ?></h3>
			<h4 class="spotlight_takeover_intro_title"><?php echo get_field($item)['title'] ?></h4>
			<!-- only program 1-->
			<div class="spotlight_takeover_intro_body">
				<div class="input_wrapper spotlight_takeover_input_wrapper">
					<input class="input_field spotlight_takeover_input_field" type="search" id="search_by_keyword" placeholder="Search by keyword" />
					<label class="input_label spotlight_takeover_input_label">Search by keyword</label>
				</div>
				<div class="spotlight_takeover_select_wrapper">
					<label class="spotlight_takeover_select_label" for="spotlight_takeover_select">Or Filter By…</label>
					<select class="spotlight_takeover_select" id="spotlight_takeover_select">
						<option value="0">Area of Study</option>
						<?php foreach ($program_terms as $program_term): ?>
							<option value="<?php echo $program_term->slug ?>" data-taxname="<?php echo $program_term->name ?>" >
								<?php echo $program_term->name ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div><!-- only program 1-->
		</div>
	</div>

	<div class="spotlight_takeover_content" id="spotlight_takeover_content_js">
		<div class="spotlight_takeover_content_inner">
			<div id="datafetch"></div>
			<button class="spotlight_takeover_content_next">
				<span class="spotlight_takeover_content_next_label">Discover People</span>
				<span class="spotlight_takeover_content_next_icon">
					<svg class="icon icon_close">
						<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
					</svg>
				</span>
				<span class="spotlight_takeover_content_next_progress"></span>
			</button>
		</div>
	</div>

	<div class="spotlight_takeover_content" id="spotlight_takeover_content_default">
		<div class="spotlight_takeover_content_inner">
			<div class="spotlight_takeover_details">
				<div class="spotlight_takeover_detail">
					<span class="spotlight_takeover_detail_label">Viewing/<strong class="spotlight_takeover_detail_title">All Programs</strong></span>
				</div>
				<div class="spotlight_takeover_result">
					<span class="spotlight_takeover_result_number"><?php echo count($programs_post); ?></span>
					<span class="spotlight_takeover_result_label">Results</span>
				</div>
			</div>

			<?php foreach ($programs_post as $post): ?>
				<?php setup_postdata( $post ) ?>
				<?php $t_types = wp_get_post_terms($post->ID, 'areas-of-study', array("fields" => "all")); ?>

				<article class="program <?php foreach($t_types as $key => $value){echo $value->slug.' ';} ?>">
					<?php if (get_field('video_url')): ?>
						<div class="video_item">
							<figure class="video_item_figure">
								<picture class="video_item_picture">
									<?php if (get_field('image')): ?>
										<source media="(min-width: 740px)" srcset="<?php tric_image(get_field('image'), '980x552') ?>" />
										<source media="(min-width: 0px)" srcset="<?php tric_image(get_field('image'), '740x416') ?>" />
										<img class="video_item_image" src="<?php tric_image(get_field('image'), '980x552') ?>" alt="">
									<?php else: ?>
										<img class="video_item_image" src="<?php echo tric_video_support::get_thumb_url(get_field('video_url')) ?>" alt="">
									<?php endif ?>
								</picture>
								<button class="video_item_video" title="play video" data-url="<?php echo tric_video_support::render_video(get_field('video_url')) ?>">
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
							<div class="video_item_body">
								<header class="video_item_header">
									<h3 class="video_item_title"><?php the_title() ?></h3>
								</header>
							</div>
						</div>
					<?php else: ?>
						<?php if (get_field('image')): ?>
							<picture class="program_picture">
								<source media="(min-width: 740px)" srcset="<?php tric_image(get_field('image'), '980x552') ?>" />
								<source media="(min-width: 0px)" srcset="<?php tric_image(get_field('image'), '740x416') ?>" />
								<img class="program_image" src="<?php tric_image(get_field('image'), '980x552') ?>" alt="">
							</picture>
						<?php endif ?>
						<div class="program_body">
							<header class="program_header">
								<h3 class="program_title">
									<a class="program_title_link" <?php tric_tblank(get_field('link')) ?> href="<?php the_field('link') ?>">
										<span class="program_title_link_label"><?php the_title() ?></span>
										<span class="program_title_link_icon" aria-hidden="true">
											<svg class="icon icon_arrow_right">
												<use xlink:href="<?php echo tric_icon('arrow_right') ?>"></use>
											</svg>
										</span>
									</a>
								</h3>

								<?php if (get_field('degrees_offered')): ?>
									<div class="program_details">
										<span class="program_degrees">
											<?php foreach (get_field('degrees_offered') as $i => $degrees_offered): ?>
												<span class="program_degree">
													<?php echo (count(get_field('degrees_offered')) != $i+1) ? $degrees_offered.',' : $degrees_offered ?>
												</span>
											<?php endforeach ?>
										</span>
									</div>
								<?php endif ?>

							</header>
							<div class="program_caption"><?php the_field('blurb') ?></div>
							<a class="program_link" <?php tric_tblank(get_field('link')) ?> href="<?php the_field('link') ?>">
								<span class="program_link_label">Learn More</span>
								<span class="program_link_icon" aria-hidden="true">
									<svg class="icon icon_arrow_right">
										<use xlink:href="<?php echo tric_icon('arrow_right') ?>"></use>
									</svg>
								</span>
							</a>
						</div>
					<?php endif ?>
				</article>
			<?php endforeach ?>
			<button class="spotlight_takeover_content_next">
				<span class="spotlight_takeover_content_next_label">Discover People</span>
				<span class="spotlight_takeover_content_next_icon">
					<svg class="icon icon_close">
						<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
					</svg>
				</span>
				<span class="spotlight_takeover_content_next_progress"></span>
			</button>
		</div>
		<?php wp_reset_postdata() ?>
	</div>
</div>