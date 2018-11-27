<?php
/**
 * Template Name: News & Media Landing
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$page_title = get_field( 'page_title' );

		if ( ! $page_title ) {
			$page_title = get_the_title();
		}

		$featured_category = get_field( 'featured_category' );

		list($featured_article) = get_posts(array(
			"posts_per_page" => 1,
		    "post_type"      => "post",
		    "category"       => $featured_category->slug,
		));

		$featured_title = get_the_title( $featured_article->ID );
		$featured_link  = get_the_permalink( $featured_article->ID );
		$featured_image = get_field( 'image', $featured_article->ID );

		$news = get_posts(array(
			"posts_per_page" => 5,
		    "post_type"      => "post",
		));
?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<article class="theme_red story_feature margined_md_bottom">
	<figure class="responsive_image story_feature_figure_full">
		<img class="story_feature_image_full" src="<?php echo fielding_image( $featured_image, 'full-xsml' ); ?>" alt="">
	</figure>
	<div class="fs-row">
		<div class="fs-cell">
			<div class="story_feature_wrapper">
				<div class="fs-row">
					<div class="fs-cell fs-xs-hide fs-sm-1 fs-md-half fs-lg-half fs-xl-half right_sm">
						<figure class="story_feature_figure">
							<?php fielding_responsive_image( fielding_image_news_featured( $featured_image ), 'story_feature_picture' ); ?>
						</figure>
					</div>
					<div class="fs-cell fs-xs-full fs-sm-2 fs-md-half fs-lg-half fs-xl-half">
						<div class="story_feature_content">
							<header class="story_feature_header">
								<h2 class="story_feature_label">Featured Story</h2>
							</header>
							<h3 class="story_feature_title"><?php echo $featured_title; ?></h3>
							<a class="btn story_feature_button" href="<?php echo $featured_link; ?>" aria-label="<?php echo $featured_title; ?>">Continue Reading</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<header class="page_header">
	<div class="fs-row">
		<div class="fs-cell typography">
			<h1 class="heading_red"><?php echo $page_title; ?></h1>
		</div>
	</div>
</header>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="short_events_wrap clearfix">
				<div class="short_events">
					<?php
						$theme_dir = get_template_directory();

						include $theme_dir . "/layouts/partial/news-filters.php";
						include $theme_dir . "/layouts/partial/news-list.php";
					?>
					<div class="margined_top margined_md_bottom contain">
						<a href="<?php fielding_page_link( 'news_archives' ); ?>" class="btn btn_gray">View All News</a>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();