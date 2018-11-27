<?php
global $fielding_news_active;
global $fielding_news_page;

$fielding_news_active  = true;

get_header();

$page_title = '';

if ( isset( $_GET['s'] ) ) {
	$page_title = 'Results for "' . $_GET['s'] . '"';
	$fielding_news_page = $page_title;
} else if ( is_category() ) {
	$page_title = single_term_title( '', false );
	$fielding_news_page = $page_title;
} else if ( ! $page_title ) {
	$page_title = "News Archives";
}

?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<header class="page_header">
	<div class="fs-row">
		<div class="fs-cell typography">
			<h1><?php echo $page_title; ?></h1>
		</div>
	</div>
</header>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav', 'news' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="short_events_wrap clearfix">
				<div class="short_events">
					<?php
						$news = $posts;

						$theme_dir = get_template_directory();

						include $theme_dir . "/layouts/partial/news-filters.php";
						include $theme_dir . "/layouts/partial/news-list.php";

						fielding_pagination();
					?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'layouts/sidebar', 'news' ); ?>
	</div>
</div>
<?php
get_footer();