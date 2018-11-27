<?php
/**
 * Template part for displaying page content in archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$cpt = get_queried_object();
?>

<div class="page_feature"></div>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page_header">
		<div class="page_header_inner">
			<div class="fs-row">
			    <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
					<div class="page_header_body">
						<h1 class="page_title"><?php echo $cpt->label ?></h1>
					</div>
				 </div>
			</div>
		</div>
		<?php get_template_part( 'inc/partials/feature', 'filter' ); ?>
	</div><!-- .page_header -->

	<div class="page_content">
		<div class="full_width_callouts">
			<?php get_template_part( 'inc/full-width-components/template', 'news-page' ); ?>
		</div>
	</div><!--.page_content-->

</div><!-- #post-<?php the_ID(); ?> -->
