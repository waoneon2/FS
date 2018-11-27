<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'layouts/page-header' );
?>
<div class="page_content_area">
	<div class="fs-row">
		<?php get_template_part( 'layouts/subnav' ); ?>
		<div class="fs-cell fs-lg-8 page_content">
			<div class="typography">
				<?php the_content(); ?>
			</div>
			<?php get_template_part( 'layouts/callouts', 'in-content' ); ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_template_part( 'layouts/callouts', 'full-width' ); ?>
</div>
<?php
	endwhile;
endif;

get_footer();