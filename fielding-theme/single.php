<?php
global $fielding_news_active;
global $fielding_news_page;

$fielding_news_active = true;
$fielding_news_page   = get_the_title();

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'layouts/page-header' );
?>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav', 'news' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="typography">
				<?php the_content(); ?>
			</div>
		</div>
		<?php get_template_part( 'layouts/sidebar', 'news' ); ?>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();