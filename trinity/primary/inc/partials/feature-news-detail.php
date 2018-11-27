<?php
/**
 * Template for news detail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$taxonomy 	= 'news-category';
$term_obj 	= get_the_terms($post, $taxonomy);
$term 		= $term_obj[0]? $term_obj[0]->name : '';
?>

<div class="news_item_details_block">
	<div class="news_item_details_inner">
		<div class="news_item_details">

			<?php if ($term): ?>
				<span class="news_item_detail">
					<span class="news_item_label"><?php echo $term ?></span>
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
	</div>
</div>