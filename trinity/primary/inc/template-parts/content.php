<?php
/**
 * Template part for displaying single post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

?>
<div class="page_feature"></div>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page_header">
		<?php if (get_field('header_image')): ?>
			<div class="js-background page_background" data-background-options='{"source": {
				"0px": "<?php tric_image(get_field('header_image'),'740x555') ?>",
				"500px": "<?php tric_image(get_field('header_image'),'980x552') ?>",
				"980px": "<?php tric_image(get_field('header_image'),'1220x686') ?>",
				"1220px": "<?php tric_image(get_field('header_image'),'1440x617') ?>"
			}}'></div>
		<?php endif ?>
		<div class="page_header_inner">
			<div class="fs-row">
				<!-- Main Content -->
				 <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
					<div class="page_header_body">
						<a class="page_back" href="<?php echo home_url( '/news' )  ?>">
							<span class="page_back_icon">
								<svg class="icon icon_back">
									<use xlink:href="<?php tric_icon('back') ?>"></use>
								</svg>
							</span>
							<span class="page_back_label">Back to <?php echo 'News' ?></span>
						</a>
						<h1 class="page_title"><?php the_title() ?></h1>
						<?php get_template_part( 'inc/partials/feature', 'news-detail' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .page_header -->

	<div class="page_content">
		<div class="fs-row">
			<!-- Main Content -->
			<div class="fs-cell fs-lg-11 fs-xl-9 fs-xl-push-1 content_wrapper">
				<main class="main_content" id="main_content" itemprop="mainContentOfPage">
					<!-- WYSIWYG - wrap all WYSIWYG text areas in `.typography` -->
					<div class="typography">
						<?php the_content() ?>
					</div>
					<!-- END: WYSIWYG -->
					<!-- In Content Callouts -->
					<div class="in_content_callouts">
						<?php
							if (get_field('in-content_components')) {
							tric_the_in_content_components(get_field('in-content_components'));
						}
					?>
					</div>
					<!-- END: In Content Callouts -->
				</main>
			</div>
			<!-- END: Main Content -->
		</div>
		<!-- Full Width Callouts -->
		<div class="full_width_callouts">
			<?php
				if (get_field('full-width_components')) {
					tric_the_full_width_components(get_field('full-width_components'));
				}
			?>
			<?php include get_template_directory() . '/inc/full-width-components/template-share.php' ?>
		</div>
		<!-- END: Full Width Callouts -->
	</div><!-- .page_content -->

</div><!-- #post-<?php the_ID(); ?> -->
