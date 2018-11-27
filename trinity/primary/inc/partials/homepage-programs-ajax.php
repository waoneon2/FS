
<?php
	global $post;

	$item = 'programs';
	$keyword = esc_attr( $_POST['keyword'] );
	$type = esc_attr( $_POST['type'] );

	if ($type == 'search') {
		$args = array(
			'posts_per_page' 	=> -1,
			'post_type'		 	=> 'programs_post',
			'orderby' 			=> 'title',
			'order' 			=> 'ASC'
		);

		// Meta Query
		$meta_query['relation'] = 'OR';
		$meta_query[] = array(
		    'key' 				=> 'keywords',
		    'value' 			=> $keyword,
		    'compare' 			=> 'LIKE'
		);
		$meta_query[] = array(
		    'key' 				=> 'blurb',
		    'value' 			=> $keyword,
		    'compare' 			=> 'LIKE'
		);
		$meta_query[] = array(
		    'key' 				=> 'title',
		    'value' 			=> $keyword,
		    'compare' 			=> 'LIKE'
		);
		$args['meta_query'] = $meta_query;

		$keyword = 'Keyword: '.$keyword;
	} else {
        $args = array(
            'posts_per_page'    => -1,
            'post_type'         => 'programs_post',
            'orderby'           => 'title',
            'order'             => 'ASC',
            'tax_query'         => array(
            array(
                'taxonomy'  => 'areas-of-study',
                'field'     => 'slug',
                'terms'     => $keyword,
            ),
        ));
        $keyword = isset($_POST['label']) ? $_POST['label'] : '';
	}

	$programs_post = new WP_Query($args);
?>

<div class="spotlight_takeover_details">
	<div class="spotlight_takeover_detail">
		<span class="spotlight_takeover_detail_label">Viewing/<strong class="spotlight_takeover_detail_title"><?php echo $keyword ?></strong></span>
	</div>
	<div class="spotlight_takeover_result">
		<span class="spotlight_takeover_result_number"><?php echo $programs_post->post_count ?></span>
		<span class="spotlight_takeover_result_label">Results</span>
	</div>
</div>

<?php if ($programs_post->post_count): ?>

	<?php foreach ($programs_post->posts as $post): ?>
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
	<?php wp_reset_postdata() ?>

<?php else: ?>
	<div class="program_caption">No Results Found. Please Try Again.</div>
<?php endif ?>
